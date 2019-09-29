{{--@if ($errors->any())--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-10">--}}
{{--                <div class="alert alert-danger">--}}
{{--                    <ul>--}}
{{--                        @foreach ($errors->all() as $errorTxt)--}}
{{--                            <li>{{ $errorTxt }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}
@if ($errors->any())
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <ul class="list-group">
                        @foreach ($errors->all() as $errorTxt)
                            <li class="list-group-item list-group-item-danger">{{ $errorTxt }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endif
@if (session('success'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    {{ session()->get('success') }}
                </div>
            </div>
        </div>
    </div>
@endif
@if (session('status'))
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                        <div class="alert alert-info">
                            {{session('status')}}
                        </div>

                </div>
            </div>
        </div>
@endif
