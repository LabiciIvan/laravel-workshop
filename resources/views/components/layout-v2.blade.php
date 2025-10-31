<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pixel Positions</title>
</head>
<body>

    <div>
        <nav>
            <div>
                <a href="">
                    <img src="{{Vite::asset('resources/images/logo.svg')}}" alt="">
                </a>
            </div>
 
            <div>link</div>

            <div>post a job</div>

        </nav>

        <main>
            {{ $slot }}
        </main>
    </div>
    
</body>
</html>