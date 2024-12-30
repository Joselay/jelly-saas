<script setup lang="ts">
import { Button } from "@/components/ui/button";
import { cn } from "@/lib/utils";
import { Link } from "@inertiajs/vue3";

interface Item {
    title: string;
    href: string;
}

const sidebarNavItems: Item[] = [
    {
        title: "Profile",
        href: "/settings/profile",
    },
    {
        title: "Account",
        href: "/settings/account",
    },
    {
        title: "Appearance",
        href: "/settings/appearance",
    },
    {
        title: "Notifications",
        href: "/settings/notifications",
    },
];
</script>

<template>
    <nav class="flex space-x-2 lg:flex-col lg:space-x-0 lg:space-y-1">
        <Link
            v-for="item in sidebarNavItems"
            :key="item.title"
            :href="item.href"
        >
            <Button
                variant="ghost"
                :class="
                    cn(
                        'w-full text-left justify-start'
                        // $route.path === `${item.href}.html` && 'bg-muted hover:bg-muted',
                    )
                "
            >
                {{ item.title }}
            </Button>
        </Link>
    </nav>
</template>
