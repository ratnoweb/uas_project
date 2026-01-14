<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Lombok News - Portal Berita Terpercaya Lombok')</title>

    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>
    tailwind.config={theme:{extend:{colors:{primary:'#1e3a8a',secondary:'#dc2626'},borderRadius:{
        'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'
    }}}}
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">

    <style>
        :where([class^="ri-"])::before { content: "\f3c2"; }
        body { font-family: 'Inter', sans-serif; }
        .logo-font { font-family: 'Pacifico', serif; }
        .news-card:hover { transform: translateY(-2px); transition: all 0.3s ease; }
        .carousel-item { display: none; }
        .carousel-item.active { display: block; }
        .nav-item:hover { background-color: #dc2626; transition: all 0.3s ease; }
        .text-truncate-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .text-truncate-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    </style>
</head>

<body class="bg-gray-50">

@include('components.header')
@include('components.navbar')

@yield('content')

@include('components.footer')

@include('scripts.datetime')
@include('scripts.mobile-menu')
@include('scripts.carousel')

</body>
</html>
