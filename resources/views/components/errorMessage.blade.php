@if ($errors->any())
    <div>

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="m-0">

                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
