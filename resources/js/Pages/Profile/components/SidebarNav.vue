<script setup lang="ts">
import { Button } from "@/components/ui/button";
import { cn } from "@/lib/utils";

interface Item {
    title: string;
    href: string;
}

const sidebarNavItems: Item[] = [
    {
        title: "Profile",
        href: "/profile",
    },
    {
        title: "Account",
        href: "/account",
    },
    {
        title: "Appearance",
        href: "/appearance",
    },
    {
        title: "Notifications",
        href: "/notifications",
    },
];
</script>

<template>
    <nav class="flex space-x-2 lg:flex-col lg:space-x-0 lg:space-y-1">
        <Button
            v-for="item in sidebarNavItems"
            :key="item.title"
            as="a"
            :href="item.href"
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
    </nav>
</template>
