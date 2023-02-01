@extends('layout')

@section('content')

    <div class="row mt-3">
        <div class="col">
            <a href="{{ $playLink }}" class="btn btn-primary ajax-link">Imfeelinglucky</a>
            <a href="{{ $historyLink }}" class="btn btn-info ajax-link">History</a>
        </div>

        <div class="col">
            <div class="row">
                <div class="col-4">Number</div>
                <div class="col-4">Result</div>
                <div class="col-4">Profit</div>
            </div>

            <div class="row" id="result">

            </div>
        </div>

        <div class="col">
            <a href="{{ $createNewSpecialPageLink }}" class="btn btn-success">Create new page</a>
            <a href="{{ $deleteCurrentSpecialPageLink }}" class="btn btn-danger">Delete current page</a>
        </div>
    </div>



    <script>
        $(function() {
            const clickView = function(click) {
                // $('<div class="col"></div>')
                let $div = $('<div class="row"></div>');
                $div.append(
                    $('<div class="col-4">' + click.number + '</div>')
                )

                $div.append(
                    $('<div class="col-4">' + (click.is_win ? 'Win' : 'Lose') + '</div>')
                )

                $div.append(
                    $('<div class="col-4">' + click.profit + '</div>')
                )
                return $div;
            }


            $('.ajax-link').on('click', function(e) {
                e.preventDefault();
                let $resultView = $('#result');
                $.ajax({
                    url: $(this).attr('href'),
                    method: 'get',
                    success: function(response) {
                        $resultView.html('');
                        response.clicks.forEach(
                            click => $resultView.append(clickView(click))
                        );
                    }
                })
            })
        })
    </script>

@endsection
