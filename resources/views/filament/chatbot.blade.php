<div id="chatbot-root"
    data-stream-url="{{ route('chatbot.stream') }}"
    data-csrf="{{ csrf_token() }}"
    data-rps-id="@isset($rps){{ $rps->id }}@endisset">
</div>

{{-- Container posisi kanan bawah --}}
<div id="chatbot-container" style="
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 12px;
">

    {{-- Chat Window --}}
    <div id="chatbot-box" style="
        display: none;
        width: 320px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 40px rgba(0,0,0,0.15);
        border: 1px solid rgba(0,0,0,0.08);
        overflow: hidden;
        font-family: inherit;">

        {{-- Header --}}
        <div style="display:flex; align-items:center; justify-content:space-between;
                    padding: 12px 16px; background: #16a34a;">
            <div style="display:flex; align-items:center; gap:10px;">
                <div style="width:32px; height:32px; border-radius:10px;
                            background:rgba(255,255,255,0.2); display:flex;
                            align-items:center; justify-content:center; font-size:14px;">🤖</div>
                <div>
                    <div style="color:white; font-size:13px; font-weight:600;">Asisten RPS</div>
                    <div style="display:flex; align-items:center; gap:5px;">
                        <span style="width:6px;height:6px;border-radius:50%;background:#86efac;"></span>
                        <span style="color:rgba(255,255,255,0.75);font-size:11px;">Online</span>
                    </div>
                </div>
            </div>
            <button onclick="toggleChatbot()" style="
                width:28px;height:28px;border-radius:8px;border:none;
                background:rgba(255,255,255,0.15);
                color:rgba(255,255,255,0.8);cursor:pointer;">✕</button>
        </div>

        {{-- Messages --}}
        <div id="chatbot-messages" style="
            display:flex;flex-direction:column;gap:10px;
            padding:16px;overflow-y:auto;max-height:360px;
            background:#f8fafc;">
        </div>

        {{-- Input --}}
        <div style="padding:12px;background:white;border-top:1px solid #f1f5f9;">
            <div style="display:flex;gap:8px;padding:8px 12px;
                        background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:12px;">
                <input id="chatbot-input" type="text" placeholder="Tanya tentang RPS..."
                    style="flex:1;background:transparent;border:none;outline:none;font-size:13px;" />

                <button id="chatbot-send-btn" onclick="sendChatbotMessage()" style="
                    width:32px;height:32px;border-radius:8px;border:none;
                    background:#16a34a;color:white;cursor:pointer;">
                    ➤
                </button>
            </div>

            <div style="text-align:center;font-size:11px;color:#cbd5e1;margin-top:8px;">
                Powered by Qwen AI
            </div>
        </div>
    </div>

    {{-- Toggle Button --}}
  <button id="chatbot-toggle-btn" onclick="toggleChatbot()" style="
    width:56px;
    height:56px;
    border-radius:16px;
    background:#16a34a;
    color:white;
    border:none;
    cursor:pointer;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:22px;
    line-height:1;

    padding:0;
    box-shadow:0 4px 20px rgba(22,163,74,0.4);
">
    🤖
</button>

</div>

<style>
    #chatbot-messages::-webkit-scrollbar { width: 4px; }
    #chatbot-messages::-webkit-scrollbar-track { background: transparent; }
    #chatbot-messages::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 99px; }

    #chatbot-toggle-btn:hover { transform: scale(1.05); box-shadow: 0 6px 24px rgba(22,163,74,0.5) !important; }

    @keyframes chatSlideUp {
        from { opacity: 0; transform: translateY(10px) scale(0.98); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }
    @keyframes bubbleIn {
        from { opacity: 0; transform: translateY(6px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .chat-bubble-ai, .chat-bubble-user { animation: bubbleIn 0.2s cubic-bezier(0.16, 1, 0.3, 1); }

    .typing-dot { animation: typingBounce 1.2s infinite; color: #94a3b8; font-size: 8px; margin: 0 1px; display: inline-block; }
    .typing-dot:nth-child(2) { animation-delay: 0.2s; }
    .typing-dot:nth-child(3) { animation-delay: 0.4s; }
    @keyframes typingBounce {
        0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
        30% { transform: translateY(-4px); opacity: 1; }
    }

    #chatbot-messages .prose-chat { color: #334155; font-size: 13px; line-height: 1.6; }
    #chatbot-messages .prose-chat strong { color: #0f172a; }
    #chatbot-messages .prose-chat ul { padding-left: 1rem; margin: 0.3rem 0; }
    #chatbot-messages .prose-chat li { margin: 0.15rem 0; }
    #chatbot-messages .prose-chat p  { margin: 0.25rem 0; }
    #chatbot-messages .prose-chat code {
        background: #f1f5f9; padding: 0.1rem 0.4rem;
        border-radius: 4px; font-size: 0.8em; color: #0ea5e9;
    }
</style>

<script src="{{ asset('js/chatbot.js') }}"></script>