@php($placeholder = __('You are a surprise that I will only meet once in my life', 'sakura'))
{{-- <p class="m-5 italic">
    <i class="fa-brands fa-markdown"></i> Markdown Supported
</p> --}}
<div class="comment-textarea relative my-5">
    <textarea class="commentbody peer p-5 w-full rounded outline outline-1 outline-slate-200 hover:outline-theme-primary" placeholder="{{ $placeholder }}" name="comment" id="comment" rows="5" tabindex="4"></textarea>
    <label class="input-label absolute left-5 top-5 text-fg-tertiary transition-all
    pointer-events-none origin-top-left rounded duration-300
    peer-text-prompt:-translate-y-1/2 peer-text-prompt:text-theme-fg-primary peer-text-prompt:bg-theme-primary
    peer-text-prompt:scale-75 peer-text-prompt:left-2 peer-text-prompt:top-0 peer-text-prompt:p-1.5">
        {{ $placeholder }}
    </label>
</div>
{{-- <div id="upload-img-show"></div>
<!--sticker/emoji panel-->
<p id="emotion-toggle" class="no-select">
    <span class="emotion-toggle-off">{{ __('Click me OωO', 'sakura') }}</span>
    <span class="emotion-toggle-on">{{ __('Woooooow ヾ(≧∇≦*)ゝ', 'sakura') }}</span>
</p>
<div class="emotion-box no-select">
    <table class="motion-switcher-table">
        <tr>
            <th onclick="motionSwitch(' .bili')" class="bili-bar on-hover">bilibili~</th>
            <th onclick="motionSwitch('.menhera')" class="menhera-bar">(=・ω・=)</th>
            <th onclick="motionSwitch('.tieba')" class="tieba-bar">Tieba</th>
        </tr>
    </table>
    <div class="bili-container motion-container">
        {{ push_bili_smilies() }}
    </div>
    <div class="menhera-container motion-container" style="display:none;">
        {{ push_emoji_panel() }}
    </div>
    <div class="tieba-container motion-container" style="display:none;">
        {{ push_smilies() }}
    </div>
</div> --}}
