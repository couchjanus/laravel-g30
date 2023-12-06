<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <meta name="csrf-token" content="{{ csrf_token() }}">
       <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
       <style> @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"); </style>
       
       <tallstackui:script /> 
       <tallstackui:style />
       
       @vite(['resources/css/app.css', 'resources/js/app.js'])
       @livewireStyles
   </head>

   <body class="bg-gray-100 font-family-karla flex">
       @livewire('admin.side-bar')
       <div class="w-full flex flex-col h-screen overflow-y-hidden">
         @livewire('admin.nav-bar')
         <div class="w-full overflow-x-hidden border-t flex flex-col">
           <main class="w-full flex-grow p-6">
               @if (isset($header))
                   {{ $header }}
               @endif

               <x-admin.alert />
               {{ $slot }}
           </main>
         </div>
       </div>
       @stack('modals')
       @livewireScripts
   </body>
</html>
