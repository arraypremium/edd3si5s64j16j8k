<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facility Access Suspended | Gymie</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif; }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="bg-gray-800 border border-red-500/30 rounded-2xl p-8 max-w-lg w-full text-center shadow-2xl shadow-red-950/20">
        <div class="w-20 h-20 bg-red-500/10 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 border border-red-500/20">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        
        <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-white mb-3">
            Facility Access Suspended
        </h1>
        
        <div class="bg-red-950/40 border border-red-800/40 rounded-xl p-4 mb-6 text-left">
            <p class="text-sm text-red-200 leading-relaxed font-medium text-center">
                Access to <strong class="text-white">{{ $gym->name ?? 'this facility' }}</strong> has been temporarily suspended by Site Administration.
            </p>
        </div>

        <p class="text-gray-400 text-sm mb-8 leading-relaxed">
            All management operations, member portals, and billing services are temporarily locked. If you believe this is an error or need to resolve an outstanding balance, please contact central site support.
        </p>

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="mailto:{{ \App\Models\Gym::where('slug', 'central-gym')->first()?->contact_email ?? 'support@gymie.com' }}" class="bg-red-600 hover:bg-red-500 text-white font-semibold py-3 px-6 rounded-xl transition duration-200 ease-in-out shadow-lg shadow-red-600/30 text-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Contact Site Support
            </a>
            <a href="/" class="bg-gray-700 hover:bg-gray-600 text-gray-200 font-semibold py-3 px-6 rounded-xl transition duration-200 ease-in-out text-sm flex items-center justify-center">
                Return to Home
            </a>
        </div>
    </div>
</body>
</html>
