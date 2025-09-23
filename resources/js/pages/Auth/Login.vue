<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import AuthenticationCard from "@/components/AuthenticationCard.vue";
import Checkbox from "@/components/Checkbox.vue";
import InputError from "@/components/InputError.vue";
import InputLabel from "@/components/InputLabel.vue";
import PrimaryButton from "@/components/PrimaryButton.vue";
import TextInput from "@/components/TextInput.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const isLoading = ref(false);

const submit = () => {
    isLoading.value = true;
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => {
            form.reset("password");
            isLoading.value = false;
        },
    });
};

const loginWithGoogle = () => {
    window.location.href = route("auth.google");
};

const parallaxOffset = ref(0);

onMounted(() => {
    const handleScroll = () => {
        parallaxOffset.value = window.pageYOffset * 0.5;
    };

    window.addEventListener("scroll", handleScroll);

    return () => {
        window.removeEventListener("scroll", handleScroll);
    };
});
</script>

<template>
    <Head title="Welcome Back" />

    <!-- Parallax background container -->
    <div class="parallax-container">
        <div class="parallax-layer"></div>
        <div class="parallax-layer"></div>
        <div class="parallax-layer"></div>
    </div>

    <!-- Main container with enhanced styling -->
    <div
        class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative"
    >
        <div class="max-w-md w-full space-y-8">
            <!-- Modern header section -->
            <div
                class="bg-white rounded-2xl shadow-2xl border border-border/50 p-8 space-y-6"
            >
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-foreground mb-2">
                        Welcome Back!
                    </h2>
                    <p class="text-muted-foreground text-sm">
                        Sign in to your account to continue
                    </p>
                </div>

                <!-- Enhanced card with backdrop blur -->

                <div
                    v-if="status"
                    class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-200"
                >
                    {{ status }}
                </div>

                <!-- Google login button -->
                <button
                    @click="loginWithGoogle"
                    type="button"
                    class="w-full flex justify-center items-center gap-3 py-3 px-4 border border-border rounded-lg text-sm font-medium text-card-foreground bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-200 shadow-sm"
                >
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path
                            fill="#4285F4"
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                        />
                        <path
                            fill="#34A853"
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                        />
                        <path
                            fill="#FBBC05"
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                        />
                        <path
                            fill="#EA4335"
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                        />
                    </svg>
                    Continue with Google
                </button>

                <!-- Divider -->
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-border"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500"
                            >Or continue with</span
                        >
                    </div>
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <div class="space-y-4">
                        <div>
                            <InputLabel
                                for="email"
                                value="Email Address"
                                class="text-sm font-medium text-card-foreground"
                            />
                            <TextInput
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="mt-2 block w-full px-4 py-3 border border-border rounded-lg text-sm placeholder-muted-foreground bg-input focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
                                placeholder="Enter your email"
                                required
                                autofocus
                                autocomplete="username"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>

                        <div>
                            <InputLabel
                                for="password"
                                value="Password"
                                class="text-sm font-medium text-card-foreground"
                            />
                            <TextInput
                                id="password"
                                v-model="form.password"
                                type="password"
                                class="mt-2 block w-full px-4 py-3 border border-border rounded-lg text-sm placeholder-muted-foreground bg-input focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
                                placeholder="Enter your password"
                                required
                                autocomplete="current-password"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.password"
                            />
                        </div>
                    </div>

                    <!-- Remember me and forgot password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <Checkbox
                                v-model:checked="form.remember"
                                name="remember"
                                class="rounded border-border text-primary focus:ring-primary"
                            />
                            <span class="ml-2 text-sm text-card-foreground"
                                >Remember me</span
                            >
                        </label>

                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="text-sm text-primary hover:text-primary/80 font-medium transition-colors duration-200"
                        >
                            Forgot password?
                        </Link>
                    </div>

                    <!-- Login button with loading state -->
                    <PrimaryButton
                        type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-primary-foreground bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        :class="{ 'opacity-75': form.processing || isLoading }"
                        :disabled="form.processing || isLoading"
                    >
                        <svg
                            v-if="form.processing || isLoading"
                            class="animate-spin -ml-1 mr-3 h-5 w-5 text-primary-foreground"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            ></circle>
                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                            ></path>
                        </svg>
                        {{
                            form.processing || isLoading
                                ? "Signing in..."
                                : "Sign In"
                        }}
                    </PrimaryButton>
                </form>

                <!-- Sign up link -->
                <div class="text-center">
                    <p class="text-sm text-muted-foreground">
                        Don't have an account?
                        <Link
                            :href="route('register')"
                            class="font-medium text-primary hover:text-primary/80 transition-colors duration-200"
                        >
                            Sign up here
                        </Link>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.parallax-container {
    position: fixed; /* stays in background */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: -1;
}

.parallax-layer {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
}

/* Example: first layer with background */
.parallax-layer:nth-child(1) {
    background-image: url("/dipvetAssets/images/bgLaptop.png");
    transform: translateY(calc(var(--offset, 0px) * 0.5));
}

input:focus {
    box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.1);
}

button,
input,
a {
    transition: all 0.2s ease-in-out;
}

::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: transparent;
}

::-webkit-scrollbar-thumb {
    background: rgba(8, 145, 178, 0.3);
    border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(8, 145, 178, 0.5);
}
</style>
