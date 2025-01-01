<script setup lang="ts">
import type { Table } from "@tanstack/vue-table";
import type { Task } from "../data/schema";
import { Button } from "@/components/ui/button";
import {
    DropdownMenu,
    DropdownMenuCheckboxItem,
    DropdownMenuContent,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";

import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";

import { MixerHorizontalIcon, PlusIcon } from "@radix-icons/vue";

import { computed } from "vue";
import { useForm } from "@inertiajs/vue3";
import FormMessage from "@/components/ui/form/FormMessage.vue";

interface DataTableViewOptionsProps {
    table: Table<Task>;
}

const props = defineProps<DataTableViewOptionsProps>();

const columns = computed(() =>
    props.table
        .getAllColumns()
        .filter(
            (column) =>
                typeof column.accessorFn !== "undefined" && column.getCanHide()
        )
);

const form = useForm({
    label: "",
    title: "",
    assignee: "",
    status: "",
    priority: "",
});

const handleAddTask = () => {
    form.post(route("task.add"));
};
</script>

<template>
    <DropdownMenu>
        <div class="flex gap-2">
            <DropdownMenuTrigger as-child>
                <Button
                    variant="outline"
                    size="sm"
                    class="hidden h-8 ml-auto lg:flex"
                >
                    <MixerHorizontalIcon class="w-4 h-4 mr-2" />
                    View
                </Button>
            </DropdownMenuTrigger>

            <Dialog>
                <DialogTrigger as-child>
                    <Button
                        variant="outline"
                        size="sm"
                        class="hidden h-8 ml-auto lg:flex"
                    >
                        <PlusIcon class="w-4 h-4 mr-2" />
                        Add
                    </Button>
                </DialogTrigger>
                <DialogContent class="sm:max-w-[425px]">
                    <DialogHeader>
                        <DialogTitle>Add new task</DialogTitle>
                        <DialogDescription>
                            Enter the details of the task.
                        </DialogDescription>
                    </DialogHeader>

                    <div class="grid gap-4 py-4">
                        <div class="grid items-center grid-cols-4 gap-4">
                            <Label for="label" class="text-right">
                                Label
                            </Label>
                            <Select id="label" v-model="form.label">
                                <SelectTrigger class="col-span-3">
                                    <SelectValue placeholder="Choose a label" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>Label</SelectLabel>
                                        <SelectItem value="bug">
                                            Bug
                                        </SelectItem>
                                        <SelectItem value="feature">
                                            Feature
                                        </SelectItem>
                                        <SelectItem value="documentation">
                                            Documentation
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                        </div>
                        <div class="grid items-center grid-cols-4 gap-4">
                            <Label for="title" class="text-right">
                                Title
                            </Label>
                            <Input
                                v-model="form.title"
                                id="title"
                                class="col-span-3"
                            />
                        </div>

                        <div class="grid items-center grid-cols-4 gap-4">
                            <Label for="assignee" class="text-right">
                                Assignee
                            </Label>
                            <Select id="assignee" v-model="form.assignee">
                                <SelectTrigger class="col-span-3">
                                    <SelectValue
                                        placeholder="Choose assignee"
                                    />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>Assignee</SelectLabel>
                                        <SelectItem value="menglay">
                                            Menglay
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                        </div>
                        <div class="grid items-center grid-cols-4 gap-4">
                            <Label for="status" class="text-right">
                                Status
                            </Label>
                            <Select id="status" v-model="form.status">
                                <SelectTrigger class="col-span-3">
                                    <SelectValue
                                        placeholder="Choose a status"
                                    />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>Status</SelectLabel>
                                        <SelectItem value="backlog">
                                            Backlog
                                        </SelectItem>
                                        <SelectItem value="todo">
                                            Todo
                                        </SelectItem>
                                        <SelectItem value="in progress">
                                            In Progress
                                        </SelectItem>
                                        <SelectItem value="done">
                                            Done
                                        </SelectItem>
                                        <SelectItem value="canceled">
                                            Canceled
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                        </div>
                        <div class="grid items-center grid-cols-4 gap-4">
                            <Label for="priority" class="text-right">
                                Priority
                            </Label>
                            <Select id="priority" v-model="form.priority">
                                <SelectTrigger class="col-span-3">
                                    <SelectValue
                                        placeholder="Choose a priority"
                                    />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>Priority</SelectLabel>
                                        <SelectItem value="low">
                                            Low
                                        </SelectItem>
                                        <SelectItem value="medium">
                                            Medium
                                        </SelectItem>
                                        <SelectItem value="high">
                                            High
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                        </div>
                    </div>
                    <DialogFooter>
                        <Button type="submit" @click="handleAddTask">
                            Add
                        </Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        </div>
        <DropdownMenuContent align="end" class="w-[150px]">
            <DropdownMenuLabel>Toggle columns</DropdownMenuLabel>
            <DropdownMenuSeparator />

            <DropdownMenuCheckboxItem
                v-for="column in columns"
                :key="column.id"
                class="capitalize"
                :checked="column.getIsVisible()"
                @update:checked="(value) => column.toggleVisibility(!!value)"
            >
                {{ column.id }}
            </DropdownMenuCheckboxItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
