(function () {
    const root = document.getElementById("chatbot-root");
    const streamUrl = root.dataset.streamUrl;
    const csrfToken = root.dataset.csrf;
    const box = document.getElementById("chatbot-box");
    const toggleBtn = document.getElementById("chatbot-toggle-btn");

    let chatbotInitialized = false;

    marked.setOptions({ breaks: true, gfm: true });

    // ── Toggle ──
    window.toggleChatbot = function () {
        const isHidden =
            box.style.display === "none" || box.style.display === "";

        if (isHidden) {
            box.style.display = "block";
            box.style.animation =
                "chatSlideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)";
            toggleBtn.style.display = "none";
            document.getElementById("chatbot-input").focus();

            if (!chatbotInitialized) {
                chatbotInitialized = true;
                showWelcomeMessage();
            }
        } else {
            box.style.display = "none";
            toggleBtn.style.display = "flex";
        }
    };

    // ── Welcome Message ──
    function showWelcomeMessage() {
        appendBubble(
            "ai",
            `Halo! 👋 Saya asisten akademik Portal RPS UMY.\n\nKamu bisa tanya tentang:\n- 📚 Daftar mata kuliah\n- 🏫 Fakultas & Program Studi\n- 📋 CPL & CPMK mata kuliah tertentu\n- 📝 Referensi & tugas\n\nAda yang bisa saya bantu?`,
        );
    }

    // ── Send Message ──
    window.sendChatbotMessage = async function () {
        const input = document.getElementById("chatbot-input");
        const sendBtn = document.getElementById("chatbot-send-btn");
        const message = input.value.trim();
        if (!message) return;

        appendBubble("user", message);

        input.value = "";
        input.disabled = true;
        sendBtn.disabled = true;
        sendBtn.style.opacity = "0.4";

        const replyId = "reply-" + Date.now();
        appendStreamBubble(replyId);

        try {
            const response = await fetch(streamUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                    Accept: "text/event-stream",
                },
                // ✅ rps_id selalu null di Filament
                body: JSON.stringify({ message, rps_id: null }),
            });

            await handleStream(response, replyId);
        } catch (error) {
            document.getElementById(replyId)?.remove();
            appendBubble("error", error.message || "Gagal terhubung ke server");
        } finally {
            input.disabled = false;
            sendBtn.disabled = false;
            sendBtn.style.opacity = "1";
            input.focus();
            scrollToBottom();
        }
    };

    // ── Handle Stream ──
    async function handleStream(response, replyId) {
        const reader = response.body.getReader();
        const decoder = new TextDecoder();
        const bubble = document.getElementById(replyId);
        let fullText = "";

        bubble.innerHTML =
            '<span class="typing-dot">●</span><span class="typing-dot">●</span><span class="typing-dot">●</span>';

        while (true) {
            const { done, value } = await reader.read();
            if (done) break;

            for (const line of decoder.decode(value).split("\n")) {
                if (!line.startsWith("data: ")) continue;

                const raw = line.slice(6);
                if (raw === "[DONE]") return;

                const chunk = JSON.parse(raw);

                if (chunk.error) {
                    bubble.style.background = "#fef2f2";
                    bubble.style.border = "1px solid #fecaca";
                    bubble.style.color = "#ef4444";
                    bubble.innerHTML = "⚠️ " + chunk.error;
                    return;
                }

                fullText += chunk.text;
                bubble.innerHTML = marked.parse(fullText);
                bubble.className = "prose-chat";
                scrollToBottom();
            }
        }
    }

    // ── DOM Helpers ──
    function appendBubble(type, text) {
        const messagesBox = document.getElementById("chatbot-messages");

        const templates = {
            user: `
                <div class="chat-bubble-user" style="display:flex; justify-content:flex-end;">
                    <div style="background:#16a34a; color:white; padding:9px 14px;
                                border-radius:16px 16px 4px 16px; max-width:80%;
                                font-size:13px; line-height:1.5;
                                box-shadow:0 2px 8px rgba(0,0,0,0.1);">
                        ${escapeHtml(text)}
                    </div>
                </div>`,

            ai: `
                <div class="chat-bubble-ai" style="display:flex; justify-content:flex-start; gap:8px;">
                    <div style="width:26px; height:26px; border-radius:8px; background:#f1f5f9;
                                border:1px solid #e2e8f0; display:flex; align-items:center;
                                justify-content:center; font-size:12px; flex-shrink:0; margin-top:2px;">🤖</div>
                    <div class="prose-chat" style="background:white; border:1px solid #e2e8f0;
                                padding:9px 13px; border-radius:4px 16px 16px 16px;
                                max-width:calc(100% - 36px);
                                box-shadow:0 1px 4px rgba(0,0,0,0.06);">
                        ${marked.parse(text)}
                    </div>
                </div>`,

            error: `
                <div class="chat-bubble-ai" style="display:flex; justify-content:flex-start; gap:8px;">
                    <div style="width:26px; height:26px; border-radius:8px; background:#fef2f2;
                                border:1px solid #fecaca; display:flex; align-items:center;
                                justify-content:center; font-size:12px; flex-shrink:0; margin-top:2px;">⚠️</div>
                    <div style="background:#fef2f2; border:1px solid #fecaca; color:#ef4444;
                                padding:9px 13px; border-radius:4px 16px 16px 16px;
                                max-width:calc(100% - 36px); font-size:12px;">
                        ${escapeHtml(text)}
                    </div>
                </div>`,
        };

        messagesBox.innerHTML += templates[type] ?? "";
        scrollToBottom();
    }

    function appendStreamBubble(replyId) {
        const messagesBox = document.getElementById("chatbot-messages");
        messagesBox.innerHTML += `
            <div class="chat-bubble-ai" style="display:flex; justify-content:flex-start; gap:8px;">
                <div style="width:26px; height:26px; border-radius:8px; background:#f1f5f9;
                            border:1px solid #e2e8f0; display:flex; align-items:center;
                            justify-content:center; font-size:12px; flex-shrink:0; margin-top:2px;">🤖</div>
                <div id="${replyId}" style="background:white; border:1px solid #e2e8f0;
                            padding:9px 13px; border-radius:4px 16px 16px 16px;
                            max-width:calc(100% - 36px); min-width:60px;
                            box-shadow:0 1px 4px rgba(0,0,0,0.06);">
                </div>
            </div>`;
        scrollToBottom();
    }

    function scrollToBottom() {
        const el = document.getElementById("chatbot-messages");
        el.scrollTop = el.scrollHeight;
    }

    function escapeHtml(text) {
        return String(text)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;");
    }

    document
        .getElementById("chatbot-input")
        .addEventListener("keypress", function (e) {
            if (e.key === "Enter") {
                e.preventDefault();
                sendChatbotMessage();
            }
        });
})();
