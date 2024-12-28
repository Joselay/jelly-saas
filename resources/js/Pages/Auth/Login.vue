<script setup lang="ts">
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    password: "",
});

const handleSubmit = () => {
    form.post("/login");
};

const loginWithGoogle = (event: Event) => {
    event.preventDefault();
    window.location.href = "/auth/google/redirect";
};
</script>

<template>
    <Head title="Login"></Head>
    <form
        @submit.prevent="handleSubmit"
        class="w-dvw h-dvh lg:grid lg:min-h-[600px] lg:grid-cols-2 xl:min-h-[800px]"
    >
        <div class="flex items-center justify-center py-12">
            <div class="mx-auto grid w-[350px] gap-6">
                <div class="grid gap-2 text-center">
                    <h1 class="text-3xl font-bold">Login</h1>
                    <p class="text-balance text-muted-foreground">
                        Enter your email below to login to your account
                    </p>
                </div>
                <div class="grid gap-4">
                    <div class="grid gap-2">
                        <Label for="email">Email</Label>
                        <Input
                            v-model="form.email"
                            id="email"
                            type="email"
                            placeholder="m@example.com"
                            required
                        />
                        <span
                            class="text-sm text-red-500"
                            v-if="form.errors.email"
                        >
                            {{ form.errors.email }}
                        </span>
                    </div>
                    <div class="grid gap-2">
                        <div class="flex items-center">
                            <Label for="password">Password</Label>
                            <a
                                href="/forgot-password"
                                class="inline-block ml-auto text-sm underline"
                            >
                                Forgot your password?
                            </a>
                        </div>
                        <Input
                            v-model="form.password"
                            id="password"
                            type="password"
                            required
                        />
                        <span
                            class="text-sm text-red-500"
                            v-if="form.errors.password"
                        >
                            {{ form.errors.password }}
                        </span>
                    </div>
                    <Button type="submit" class="w-full"> Login </Button>
                    <Button
                        @click="loginWithGoogle"
                        variant="outline"
                        class="w-full"
                    >
                        Login with Google
                    </Button>
                </div>
                <div class="mt-4 text-sm text-center">
                    Don't have an account?
                    <Link href="/register" class="underline"> Register </Link>
                </div>
            </div>
        </div>
        <div class="hidden bg-muted lg:block">
            <img
                src="https://www.shadcn-vue.com/placeholder.svg"
                alt="Image"
                width="1920"
                height="1080"
                class="h-full w-full object-cover dark:brightness-[0.2] dark:grayscale"
            />
        </div>
    </form>
</template>
