<div id="chatbot-root"
    class="fixed bottom-6 right-6 z-50"
    data-stream-url="{{ route('chatbot.stream') }}"
    data-csrf="{{ csrf_token() }}"
    data-rps-id="{{ $rps->id ?? '' }}">

    {{-- Toggle Button --}}
    <button id="chatbot-toggle-btn" onclick="toggleChatbot()"
        class="group relative w-14 h-14 rounded-2xl bg-primary text-white flex items-center justify-center shadow-lg shadow-primary/30 hover:scale-105 hover:shadow-xl hover:shadow-primary/40 transition-all duration-300">
        <span class="text-xl transition-transform duration-300 group-hover:rotate-12">🤖</span>
        <span class="absolute inset-0 rounded-2xl bg-primary animate-ping opacity-20"></span>
    </button>

    {{-- Chat Window --}}
    <div id="chatbot-box"
        class="hidden absolute bottom-full right-0 w-80 bg-white rounded-2xl shadow-2xl overflow-hidden"
        style="border: 1px solid rgba(0,0,0,0.08);">

        {{-- Header --}}
        <div class="flex items-center justify-between px-4 py-3 bg-primary">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center text-sm">
                    🤖
                </div>
                <div>
                    <p class="text-white text-sm font-semibold">Asisten RPS</p>
                    <div class="flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-300 animate-pulse"></span>
                        <span class="text-xs text-white/70">Online</span>
                    </div>
                </div>
            </div>
            <button onclick="toggleChatbot()"
                class="w-7 h-7 rounded-lg flex items-center justify-center text-white/70 hover:text-white hover:bg-white/20 transition-all duration-200 text-xs">
                ✕
            </button>
        </div>

        {{-- Messages --}}
        <div id="chatbot-messages"
            class="flex flex-col gap-3 p-4 overflow-y-auto bg-slate-50"
            style="max-height: 360px; scrollbar-width: thin; scrollbar-color: #e2e8f0 transparent;">
        </div>

        {{-- Input --}}
        <div class="px-3 py-3 bg-white" style="border-top: 1px solid #f1f5f9;">
            <div class="flex items-center gap-2 rounded-xl px-3 py-2"
                style="background: #f8fafc; border: 1.5px solid #e2e8f0;">
                <input id="chatbot-input"
                    type="text"
                    placeholder="Tanya tentang RPS..."
                    class="flex-1 bg-transparent text-slate-700 text-sm placeholder-slate-400 focus:outline-none" />
                <button id="chatbot-send-btn" onclick="sendChatbotMessage()"
                    class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white hover:bg-primary/90 disabled:opacity-40 disabled:cursor-not-allowed transition-all duration-200 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z"/>
                    </svg>
                </button>
            </div>
            <p class="text-center text-xs text-slate-500 mt-2">Informasi dari AI mungkin tidak akurat</p>
        </div>
    </div>
</div>

<style>
    #chatbot-messages::-webkit-scrollbar { width: 4px; }
    #chatbot-messages::-webkit-scrollbar-track { background: transparent; }
    #chatbot-messages::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 99px; }

    #chatbot-box { animation: chatSlideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1); }
    @keyframes chatSlideUp {
        from { opacity: 0; transform: translateY(10px) scale(0.98); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .chat-bubble-ai, .chat-bubble-user {
        animation: bubbleIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @keyframes bubbleIn {
        from { opacity: 0; transform: translateY(6px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .typing-dot {
        animation: typingBounce 1.2s infinite;
        color: #94a3b8;
        font-size: 8px;
        margin: 0 1px;
        display: inline-block;
    }
    .typing-dot:nth-child(2) { animation-delay: 0.2s; }
    .typing-dot:nth-child(3) { animation-delay: 0.4s; }
    @keyframes typingBounce {
        0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
        30%  { transform: translateY(-4px); opacity: 1; }
    }

    #chatbot-messages .prose { color: #334155; }
    #chatbot-messages .prose strong { color: #0f172a; }
    #chatbot-messages .prose ul { padding-left: 1rem; margin: 0.3rem 0; }
    #chatbot-messages .prose li { margin: 0.15rem 0; }
    #chatbot-messages .prose p  { margin: 0.25rem 0; }
    #chatbot-messages .prose code {
        background: #f1f5f9;
        padding: 0.1rem 0.4rem;
        border-radius: 4px;
        font-size: 0.8em;
        color: #0ea5e9;
    }
</style>

<script src="{{ asset('js/chatbot.js') }}"></script>