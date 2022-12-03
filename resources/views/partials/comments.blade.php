@if (!post_password_required())
    <section id="comments" class="comments py-5 px-[6%] animate-peek-in-b-f">
        @if (have_comments())
            {{-- <h2>
                {!! /* translators: %1$s is replaced with the number of comments and %2$s with the post title */ sprintf(_nx('%1$s response to &ldquo;%2$s&rdquo;', '%1$s responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'sage'), get_comments_number() === 1 ? _x('One', 'comments title', 'sage') : number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>') !!}
            </h2> --}}
            {{-- title --}}
            <h3 class="text-fg-tertiary text-lg mb-5">Comments | <span class="text-sm"> {!! get_comments_number_text('NOTHING', '1' . __(' comment', 'sakura'), '%' . __(' comments', 'sakura')) !!}</span></h3>
            {{-- comment list --}}
            <ul class="comment-list">
                {{-- comments --}}
                {!! wp_list_comments(['type' => 'comment', 'callback' => '\ThemeNova\Post\comment_block_generator']) !!}
            </ul>

            {{-- navigation --}}
            @if (get_comment_pages_count() > 1 && get_option('page_comments'))
                @include('partials.snippet.page-nav', ['links' => paginate_comments_links(['echo' => 0, 'prev_text' => '«', 'next_text' => '»'])])
            @endif
        @endif

        @if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments'))
            <x-alert type="warning">
                {!! __('Comments are closed.', 'sage') !!}
            </x-alert>
        @endif

        @php
            $args = [
                'comment_field' => view('partials.comment.reply-textarea'),
                'comment_notes_after' => '',
                'comment_notes_before' => '',
                'fields' => apply_filters('comment_form_default_fields', [
                    'basic' => view('partials.comment.reply-fields'),
                    'qq' => '<input type="text" placeholder="QQ" name="new_field_qq" id="qq" value="' . esc_attr($comment_author_url) . '" style="display:none" autocomplete="off"/><!--此栏不可见-->',
                ]),
            ];
            comment_form($args);
        @endphp
    </section>
@endif
