<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

         <!-- Fonts -->
         <link rel="preconnect" href="https://fonts.bunny.net">
         <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
          <link
             href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css"
             rel="stylesheet"
         />
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
         <link
             rel="stylesheet"
             href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css"
             />
 
 <!-- Material Icons Link -->
         <link
         href="https://fonts.googleapis.com/icon?family=Material+Icons"
         rel="stylesheet"
         />
         <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
         <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body style="font-family: 'DM Sans', sans-serif; background-color:#f2f4f7a4">
        @inertia
    </body>
</html>
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:opsz@9..40&display=swap');
  </style>