import type { ColumnDef } from "@tanstack/vue-table";
import type { Task } from "../data/schema";

import { Badge } from "@/components/ui/badge";
import { Checkbox } from "@/components/ui/checkbox";
import { h } from "vue";
import { labels, priorities, statuses } from "../data/data";
import DataTableColumnHeader from "./DataTableColumnHeader.vue";
import DataTableRowActions from "./DataTableRowActions.vue";

export const columns: ColumnDef<Task>[] = [
    {
        id: "select",
        header: ({ table }) =>
            h(Checkbox, {
                checked:
                    table.getIsAllPageRowsSelected() ||
                    (table.getIsSomePageRowsSelected() && "indeterminate"),
                "onUpdate:checked": (value) =>
                    table.toggleAllPageRowsSelected(!!value),
                ariaLabel: "Select all",
                class: "translate-y-0.5",
            }),
        cell: ({ row }) =>
            h(Checkbox, {
                checked: row.getIsSelected(),
                "onUpdate:checked": (value) => row.toggleSelected(!!value),
                ariaLabel: "Select row",
                class: "translate-y-0.5",
            }),
        enableSorting: false,
        enableHiding: false,
    },
    {
        accessorKey: "title",
        header: ({ column }) =>
            h(DataTableColumnHeader, { column, title: "Title" }),

        cell: ({ row }) => {
            const label = labels.find(
                (label) => label.value === row.original.label
            );

            return h("div", { class: "flex space-x-2" }, [
                label
                    ? h(Badge, { variant: "outline" }, () => label.label)
                    : null,
                h(
                    "span",
                    { class: "max-w-[600px] truncate font-medium" },
                    row.getValue("title")
                ),
            ]);
        },
    },
    {
        accessorKey: "assignee",
        header: ({ column }) =>
            h(DataTableColumnHeader, { column, title: "Assignee" }),

        cell: ({ row }) => {
            const avatarUrl = row.original.assignee?.avatar;

            if (!avatarUrl) return null;

            return h("div", { class: "flex items-center space-x-2" }, [
                h("img", {
                    src: avatarUrl,
                    alt: "Assignee Avatar",
                    class: "h-8 w-8 rounded-full object-cover",
                }),
            ]);
        },
    },
    {
        accessorKey: "status",
        header: ({ column }) =>
            h(DataTableColumnHeader, { column, title: "Status" }),

        cell: ({ row }) => {
            const status = statuses.find(
                (status) => status.value === row.getValue("status")
            );

            if (!status) return null;

            return h("div", { class: "flex w-[100px] items-center" }, [
                status.icon &&
                    h(status.icon, {
                        class: "mr-2 h-4 w-4 text-muted-foreground",
                    }),
                h("span", status.label),
            ]);
        },
        filterFn: (row, id, value) => {
            return value.includes(row.getValue(id));
        },
    },
    {
        accessorKey: "priority",
        header: ({ column }) =>
            h(DataTableColumnHeader, { column, title: "Priority" }),
        cell: ({ row }) => {
            const priority = priorities.find(
                (priority) => priority.value === row.getValue("priority")
            );

            if (!priority) return null;

            return h("div", { class: "flex items-center" }, [
                priority.icon &&
                    h(priority.icon, {
                        class: "mr-2 h-4 w-4 text-muted-foreground",
                    }),
                h("span", {}, priority.label),
            ]);
        },
        filterFn: (row, id, value) => {
            return value.includes(row.getValue(id));
        },
    },
    {
        id: "actions",
        cell: ({ row }) => h(DataTableRowActions, { row }),
    },
];
