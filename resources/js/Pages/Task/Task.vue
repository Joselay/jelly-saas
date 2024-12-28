<script setup lang="ts">
import { columns } from "./components/columns";
import DataTable from "./components/DataTable.vue";
import UserNav from "./components/UserNav.vue";
import tasks from "./data/tasks.json";
</script>

<template>
    <div class="flex-col flex-1 hidden h-full p-8 space-y-8 md:flex">
        <div class="flex items-center justify-between space-y-2">
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Welcome back!</h2>
                <p class="text-muted-foreground">
                    Here&apos;s a list of your tasks for this month!
                </p>
            </div>
            <div class="flex items-center space-x-2">
                <UserNav />
            </div>
        </div>
        <DataTable :data="tasks" :columns="columns" />
    </div>
</template>
