<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<!-- Dashboard Body Component -->
<body class="min-h-screen bg-background">
    <!-- Main Content -->
    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-foreground">
                Good morning, {{ auth()->user()->name ?? 'Dr. Johnson' }} 👋
            </h1>
            <p class="text-muted-foreground mt-2">
                Here's what's happening at your clinic today
            </p>
        </div>

        <!-- Dashboard Stats -->
        <!-- [No changes needed here, keeping as-is] -->

        <!-- Quick Actions -->
        <div class="bg-card border border-border rounded-lg shadow-soft">
            <div class="p-6 border-b border-border">
                <h2 class="text-lg font-semibold text-foreground flex items-center space-x-2">
                    <svg class="h-5 w-5 text-vet-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Quick Actions</span>
                </h2>
            </div>
            <div class="p-6">
                <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2">
                    <a href="{{ route('appointments.create') }}" class="h-auto flex-col items-start space-y-2 p-4 text-left hover:shadow-soft transition-all duration-200 group border border-border rounded-lg hover:bg-accent">
                        <div class="flex w-full items-center space-x-3">
                            <div class="rounded-lg p-2 transition-all duration-200 group-hover:scale-110" style="background-color: hsl(var(--vet-primary) / 0.1)">
                                <svg class="h-4 w-4" style="color: hsl(var(--vet-primary))" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 space-y-1">
                                <p class="text-sm font-medium text-foreground group-hover:text-vet-primary transition-colors">New Appointment</p>
                                <p class="text-xs text-muted-foreground">Schedule a new patient visit</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ url('#') }}" class="h-auto flex-col items-start space-y-2 p-4 text-left hover:shadow-soft transition-all duration-200 group border border-border rounded-lg hover:bg-accent">
                        <div class="flex w-full items-center space-x-3">
                            <div class="rounded-lg p-2 transition-all duration-200 group-hover:scale-110" style="background-color: hsl(var(--vet-secondary) / 0.1)">
                                <svg class="h-4 w-4" style="color: hsl(var(--vet-secondary))" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 space-y-1">
                                <p class="text-sm font-medium text-foreground group-hover:text-vet-primary transition-colors">Add Patient</p>
                                <p class="text-xs text-muted-foreground">Register new patient</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-card border border-border rounded-lg shadow-soft">
            <div class="p-6 border-b border-border">
                <h2 class="text-lg font-semibold text-foreground flex items-center space-x-2">
                    <svg class="h-5 w-5 text-vet-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span>Recent Activity</span>
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($activities ?? [] as $activity)
                    <div class="flex items-start space-x-3 group">
                        <div class="rounded-full p-2 transition-all duration-200 group-hover:scale-110" style="background-color: hsl(var(--vet-{{ $activity->color ?? 'primary' }}) / 0.1)">
                            <svg class="h-4 w-4" style="color: hsl(var(--vet-{{ $activity->color ?? 'primary' }}))" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <!-- Activity icon here -->
                            </svg>
                        </div>
                        <div class="flex-1 space-y-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-foreground group-hover:text-vet-primary transition-colors">{{ $activity->title }}</p>
                                <span class="text-xs text-muted-foreground">{{ $activity->time }}</span>
                            </div>
                            <p class="text-xs text-muted-foreground">{{ $activity->description }}</p>
                        </div>
                    </div>
                    @empty
                    <!-- Sample activity when no data -->
                    <div class="flex items-start space-x-3 group">
                        <div class="rounded-full p-2 transition-all duration-200 group-hover:scale-110" style="background-color: hsl(var(--vet-success) / 0.1)">
                            <svg class="h-4 w-4" style="color: hsl(var(--vet-success))" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 space-y-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-foreground group-hover:text-vet-primary transition-colors">Appointment completed</p>
                                <span class="text-xs text-muted-foreground">5 mins ago</span>
                            </div>
                            <p class="text-xs text-muted-foreground">Buddy's checkup with Dr. Johnson</p>
                        </div>
                    </div>
                    @endforelse
                </div>
                <div class="mt-4 pt-4 border-t border-border">
                    <a href="{{ url('#') }}" class="text-sm text-vet-primary hover:text-vet-primary/80 transition-colors">
                        View all activity →
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>

<style>
    #root {
  max-width: 1280px;
  margin: 0 auto;
  padding: 2rem;
  text-align: center;
}

.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
  transition: filter 300ms;
}
.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}
.logo.react:hover {
  filter: drop-shadow(0 0 2em #61dafbaa);
}

@keyframes logo-spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

@media (prefers-reduced-motion: no-preference) {
  a:nth-of-type(2) .logo {
    animation: logo-spin infinite 20s linear;
  }
}

.card {
  padding: 2em;
}

.read-the-docs {
  color: #888;
}

@layer base {
  :root {
    --background: 248 50% 98%;
    --foreground: 222 84% 8%;

    --card: 0 0% 100%;
    --card-foreground: 222 84% 8%;

    --popover: 0 0% 100%;
    --popover-foreground: 222 84% 8%;

    --primary: 197 71% 52%;
    --primary-foreground: 0 0% 100%;

    --secondary: 142 69% 58%;
    --secondary-foreground: 0 0% 100%;

    --muted: 210 40% 96%;
    --muted-foreground: 215 16% 47%;

    --accent: 197 71% 96%;
    --accent-foreground: 197 71% 20%;

    --destructive: 0 84% 60%;
    --destructive-foreground: 0 0% 100%;

    --border: 214 32% 91%;
    --input: 214 32% 91%;
    --ring: 197 71% 52%;

    /* Veterinary specific colors */
    --vet-primary: 197 71% 52%;
    --vet-secondary: 142 69% 58%;
    --vet-accent: 45 93% 47%;
    --vet-neutral: 220 13% 91%;
    --vet-success: 142 69% 58%;
    --vet-warning: 45 93% 47%;
    --vet-danger: 0 84% 60%;

    /* Gradients */
    --gradient-primary: linear-gradient(135deg, hsl(var(--vet-primary)), hsl(var(--vet-secondary)));
    --gradient-subtle: linear-gradient(135deg, hsl(var(--background)), hsl(var(--accent)));

    /* Shadows */
    --shadow-soft: 0 4px 6px -1px hsl(var(--vet-primary) / 0.1);
    --shadow-medium: 0 10px 15px -3px hsl(var(--vet-primary) / 0.15);
    --shadow-large: 0 25px 50px -12px hsl(var(--vet-primary) / 0.25);

    --radius: 0.5rem;

    --sidebar-background: 0 0% 98%;

    --sidebar-foreground: 240 5.3% 26.1%;

    --sidebar-primary: 240 5.9% 10%;

    --sidebar-primary-foreground: 0 0% 98%;

    --sidebar-accent: 240 4.8% 95.9%;

    --sidebar-accent-foreground: 240 5.9% 10%;

    --sidebar-border: 220 13% 91%;

    --sidebar-ring: 217.2 91.2% 59.8%;
  }

  .dark {
    --background: 222 84% 5%;
    --foreground: 210 40% 98%;

    --card: 222 84% 6%;
    --card-foreground: 210 40% 98%;

    --popover: 222 84% 6%;
    --popover-foreground: 210 40% 98%;

    --primary: 197 71% 52%;
    --primary-foreground: 0 0% 100%;

    --secondary: 142 69% 58%;
    --secondary-foreground: 0 0% 100%;

    --muted: 217 33% 18%;
    --muted-foreground: 215 20% 65%;

    --accent: 217 33% 18%;
    --accent-foreground: 210 40% 98%;

    --destructive: 0 63% 31%;
    --destructive-foreground: 210 40% 98%;

    --border: 217 33% 18%;
    --input: 217 33% 18%;
    --ring: 197 71% 52%;

    /* Dark mode veterinary colors */
    --vet-primary: 197 71% 52%;
    --vet-secondary: 142 69% 58%;
    --vet-accent: 45 93% 47%;
    --vet-neutral: 217 33% 15%;
    --vet-success: 142 69% 58%;
    --vet-warning: 45 93% 47%;
    --vet-danger: 0 63% 31%;

    --gradient-primary: linear-gradient(135deg, hsl(var(--vet-primary)), hsl(var(--vet-secondary)));
    --gradient-subtle: linear-gradient(135deg, hsl(var(--background)), hsl(var(--accent)));

    --shadow-soft: 0 4px 6px -1px hsl(0 0% 0% / 0.3);
    --shadow-medium: 0 10px 15px -3px hsl(0 0% 0% / 0.4);
    --shadow-large: 0 25px 50px -12px hsl(0 0% 0% / 0.5);
    --sidebar-background: 240 5.9% 10%;
    --sidebar-foreground: 240 4.8% 95.9%;
    --sidebar-primary: 224.3 76.3% 48%;
    --sidebar-primary-foreground: 0 0% 100%;
    --sidebar-accent: 240 3.7% 15.9%;
    --sidebar-accent-foreground: 240 4.8% 95.9%;
    --sidebar-border: 240 3.7% 15.9%;
    --sidebar-ring: 217.2 91.2% 59.8%;
  }
}

@layer base {
  * {
    @apply border-border;
  }

  body {
    @apply bg-background text-foreground;
  }
}
</style>
</x-app-layout>
