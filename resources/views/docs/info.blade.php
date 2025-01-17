<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1 class="with-subtitle text-center mt-5"> {{ $info['heading'] }} </h1>
                <h6 class="subtitle text-center"> {{ $info['sub_heading'] }} </h6>

                <p class="contact-info text-center"> {{ $info['description'] }} </p>

                <div class="column one-half">
                    <h3 class="text-center"> Call Now </h3>
                    <div class="row my-3 gap-3">
                        <div class="col-12">
                            <input type="text" placeholder="Name" class="form-control" value="{{ $info['name'] }}"
                                disabled>
                        </div>
                        <div class="col-12">
                            <input type="text" placeholder="phone" class="form-control" value="{{ $info['phone'] }}"
                                disabled>
                        </div>
                    </div>
                    <div
                        class="header__area-menubar-right-sidebar-popup-contact-item d-flex align-items-center justify-content-center">
                        <div class="header__area-menubar-right-sidebar-popup-contact-item-icon">
                            <i class="fal fa-phone-alt icon-animation"></i>
                        </div>
                        <div class="header__area-menubar-right-sidebar-popup-contact-item-content">

                            <button type="button" class="btn btn-info"><a href="tel:{{ $info['phone'] }}"
                                    class="text-white text-decoration-none"> {{ $info['btn_text'] }} </a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
