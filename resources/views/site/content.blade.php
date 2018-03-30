<section id="page-content" class="page-wrapper">
    @if( isset($main_page_blocks) && in_array('BANNER', $main_page_blocks) )
        @include('site.content_banner')
    @endif

    @if( isset($main_page_blocks) && in_array('FEATURED_PRODUCT', $main_page_blocks) )
        @include('site.content_featured')
    @endif

    @if( isset($main_page_blocks) && in_array('UP_COMING_PRODUCT', $main_page_blocks) )
        @include('site.content_upcommings')
    @endif

    @if( isset($main_page_blocks) && in_array('PRODUCT_TAB', $main_page_blocks) )
        @include('site.content_product_tab')
    @endif

    @if( isset($main_page_blocks) && in_array('BLOG_SECTION', $main_page_blocks) )
        @include('site.content_blog_section')
    @endif  

    @if( isset($main_page_blocks) && in_array('NEWSLETTER', $main_page_blocks) ) 
        @include('site.content_newsletter')
    @endif            
</section>
