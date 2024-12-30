<script setup lang="ts">
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Link, useForm } from "@inertiajs/vue3";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";
import { ref } from "vue";
import Loading from "@/components/Loading.vue";
import OtpForm from "@/components/OtpForm.vue";
import { Head } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
});

const isLoading = ref(false);

const handleSubmit = () => {
    form.post("/send-otp", {
        onStart: (_) => {
            isLoading.value = true;
        },
        onSuccess: (_) => {
            isLoading.value = false;
        },
    });
};

defineOptions({ layout: null });
</script>

<template>
    <Head title="Register"></Head>
    <Loading :isLoading="isLoading" />

    <form
        @submit.prevent="handleSubmit"
        class="relative w-dvw h-dvh lg:grid lg:min-h-[600px] lg:grid-cols-2 xl:min-h-[800px]"
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
                        />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">Email</Label>
                        <Input
                            v-model="form.email"
                            id="email"
                            type="email"
                            placeholder="m@example.com"
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
                        />
                    </div>

                    <Dialog>
                        <DialogTrigger as-child>
                            <Button type="submit">Register</Button>
                        </DialogTrigger>
                        <DialogContent
                            v-if="!isLoading"
                            class="sm:max-w-[425px]"
                        >
                            <DialogHeader>
                                <DialogTitle>OTP Verification</DialogTitle>
                                <DialogDescription>
                                    The code has been sent to your email. Please
                                    check and verify your code within 5 minutes.
                                </DialogDescription>
                            </DialogHeader>
                            <OtpForm
                                :user="{
                                    name: form.name,
                                    email: form.email,
                                    password: form.password,
                                }"
                            />
                        </DialogContent>
                    </Dialog>
                </div>

                <div class="mt-4 text-sm text-center">
                    Already have an account?
                    <Link href="/login" class="underline">Login</Link>
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
