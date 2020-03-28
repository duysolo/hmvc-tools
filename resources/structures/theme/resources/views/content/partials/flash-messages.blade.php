@php
    $customErrors = session('errorMessages');
    $customMessages = session('successMessages');
    $customInfos = session('infoMessages');
    $customWarnings = session('warningMessages');
@endphp
<div class="container">
    @if(isset($errors)) @foreach($errors->all() as $key => $row)
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <p>{!! $row !!}</p>
        </div>
    @endforeach @endif
    @if($customErrors) @foreach($customErrors as $key => $row)
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <p>{!! $row !!}</p>
        </div>
    @endforeach @endif
    @if($customMessages) @foreach($customMessages as $key => $row)
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <p>{!! $row !!}</p>
        </div>
    @endforeach @endif
    @if($customInfos) @foreach($customInfos as $key => $row)
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <p>{!! $row !!}</p>
        </div>
    @endforeach @endif
    @if($customWarnings) @foreach($customWarnings as $key => $row)
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <p>{!! $row !!}</p>
        </div>
    @endforeach @endif
    @php do_action('flash_messages') @endphp

</div>
