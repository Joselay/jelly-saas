<script setup lang="ts">
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
});

const handleSubmit = () => {
    form.post("/register");
};
</script>

<template>
    <form
        @submit.prevent="handleSubmit"
        class="w-dvw h-dvh lg:grid lg:min-h-[600px] lg:grid-cols-2 xl:min-h-[800px]"
    >
        <div class="flex items-center justify-center py-12">
            <div class="mx-auto grid w-[350px] gap-6">
                <div class="grid gap-2 text-center">
                    <h1 class="text-3xl font-bold">Register</h1>
                    <p class="text-balance text-muted-foreground">
                        Enter your email below to register to your account
                    </p>
                </div>
                <div class="grid gap-4">
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input
                            v-model="form.name"
                            id="name"
                            type="text"
                            placeholder="John Doe"
                            required
                        />
                    </div>
                    <div class="grid gap-2">
                        <Label for="email">Email</Label>
                        <Input
                            v-model="form.email"
                            id="email"
                            type="email"
                            placeholder="m@example.com"
                            required
                        />
                    </div>
                    <div class="grid gap-2">
                        <div class="flex items-center">
                            <Label for="password">Password</Label>
                        </div>
                        <Input
                            v-model="form.password"
                            id="password"
                            type="password"
                            required
                        />
                    </div>
                    <Button type="submit" class="w-full"> Register </Button>
                </div>
                <div class="mt-4 text-sm text-center">
                    Already have an account?
                    <Link href="/login" class="underline"> Login </Link>
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
