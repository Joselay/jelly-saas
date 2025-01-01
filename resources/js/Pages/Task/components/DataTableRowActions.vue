<script setup lang="ts">
import type { Row } from "@tanstack/vue-table";
import type { Task } from "../data/schema";
import { Button } from "@/components/ui/button";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuRadioGroup,
    DropdownMenuRadioItem,
    DropdownMenuSeparator,
    DropdownMenuShortcut,
    DropdownMenuSub,
    DropdownMenuSubContent,
    DropdownMenuSubTrigger,
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

import { DotsHorizontalIcon } from "@radix-icons/vue";

import { computed, ref } from "vue";

import { labels } from "../data/data";
import { taskSchema } from "../data/schema";

import { router, useForm } from "@inertiajs/vue3";

interface DataTableRowActionsProps {
    row: Row<Task>;
}
const props = defineProps<DataTableRowActionsProps>();

const task = computed(() => taskSchema.parse(props.row.original));

const handleDelete = () => {
    router.delete(route("task.delete", props.row.original.id), {
        onSuccess: () => {
            console.log("Success deleted");
        },
    });
};
const open = ref(false);

const form = useForm({
    label: props.row.original.label,
    title: props.row.original.title,
    assignee: props.row.original.assignee,
    status: props.row.original.status,
    priority: props.row.original.priority,
});

const handleEdit = (id: number) => {
    router.patch(route("task.update", id), form.data(), {
        onSuccess: () => {
            console.log("Success updated");
            open.value = false;
        },
    });
};
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <Button
                variant="ghost"
                class="flex h-8 w-8 p-0 data-[state=open]:bg-muted"
            >
                <DotsHorizontalIcon class="w-4 h-4" />
                <span class="sr-only">Open menu</span>
            </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent align="end" class="w-[160px]">
            <DropdownMenuItem @click="open = true">Edit</DropdownMenuItem>
            <DropdownMenuItem>Make a copy</DropdownMenuItem>
            <DropdownMenuItem>Favorite</DropdownMenuItem>
            <DropdownMenuSeparator />
            <DropdownMenuSub>
                <DropdownMenuSubTrigger>Labels</DropdownMenuSubTrigger>
                <DropdownMenuSubContent>
                    <DropdownMenuRadioGroup :value="task.label">
                        <DropdownMenuRadioItem
                            v-for="label in labels"
                            :key="label.value"
                            :value="label.value"
                        >
                            {{ label.label }}
                        </DropdownMenuRadioItem>
                    </DropdownMenuRadioGroup>
                </DropdownMenuSubContent>
            </DropdownMenuSub>
            <DropdownMenuSeparator />
            <DropdownMenuItem @click="handleDelete">
                Delete
                <DropdownMenuShortcut>⌘⌫</DropdownMenuShortcut>
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>

    <Dialog :open="open">
        <DialogContent class="sm:max-w-[425px]">
            <DialogHeader>
                <DialogTitle>Edit task</DialogTitle>
                <DialogDescription>
                    Edit the details of the task.
                </DialogDescription>
            </DialogHeader>

            <div class="grid gap-4 py-4">
                <div class="grid items-center grid-cols-4 gap-4">
                    <Label for="label" class="text-right"> Label </Label>
                    <Select id="label" v-model="form.label">
                        <SelectTrigger class="col-span-3">
                            <SelectValue placeholder="Choose a label" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectLabel>Label</SelectLabel>
                                <SelectItem value="bug"> Bug </SelectItem>
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
                    <Label for="title" class="text-right"> Title </Label>
                    <Input id="title" class="col-span-3" v-model="form.title" />
                </div>

                <div class="grid items-center grid-cols-4 gap-4">
                    <Label for="assignee" class="text-right"> Assignee </Label>
                    <Select id="assignee" v-model="form.assignee">
                        <SelectTrigger class="col-span-3">
                            <SelectValue placeholder="Choose assignee" />
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
                    <Label for="status" class="text-right"> Status </Label>
                    <Select id="status" v-model="form.status">
                        <SelectTrigger class="col-span-3">
                            <SelectValue placeholder="Choose a status" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectLabel>Status</SelectLabel>
                                <SelectItem value="backlog">
                                    Backlog
                                </SelectItem>
                                <SelectItem value="todo"> Todo </SelectItem>
                                <SelectItem value="in progress">
                                    In Progress
                                </SelectItem>
                                <SelectItem value="done"> Done </SelectItem>
                                <SelectItem value="canceled">
                                    Canceled
                                </SelectItem>
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                </div>
                <div class="grid items-center grid-cols-4 gap-4">
                    <Label for="priority" class="text-right"> Priority </Label>
                    <Select id="priority" v-model="form.priority">
                        <SelectTrigger class="col-span-3">
                            <SelectValue placeholder="Choose a priority" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectLabel>Priority</SelectLabel>
                                <SelectItem value="low"> Low </SelectItem>
                                <SelectItem value="medium"> Medium </SelectItem>
                                <SelectItem value="high"> High </SelectItem>
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                </div>
            </div>
            <DialogFooter>
                <Button
                    type="submit"
                    @click="
                        handleEdit(props.row.original.id);
                        open = false;
                    "
                >
                    Edit
                </Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>
