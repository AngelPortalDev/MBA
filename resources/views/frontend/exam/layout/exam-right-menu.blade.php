@if(isset($contentId))
    @if($contentId == 'content1')
        @include('partials.content1')
    @elseif($contentId == 'content2')
        @include('partials.content2')
    @elseif($contentId == 'content3')
        @include('partials.content3')
    @else
        <h1>Welcome</h1>
        <p>Select an item from the menu to see the content.</p>
    @endif
@else
    <h1>Welcome</h1>
    <p>Select an item from the menu to see the content.</p>
@endif