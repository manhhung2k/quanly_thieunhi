<template>
    <div class="all_create h-screen flex justify-center items-center">
        <div
            class="bg-white w-5/6 flex justify-center items-center p-6 rounded-3xl shadow-lg shadow-orange-900"
        >
            <div class="w-full">
                <div class="flex gap-10 px-6 mx-auto">
                    <div
                        @click="handleCreate()"
                        class="cursor-pointer bg-slate-300 rounded-xl p-2 flex justify-center items-center"
                    >
                        <p class="text-red-500">Thêm mới thiếu nhi</p>
                    </div>
                    <h1 class="text-red-500 text-3xl font-bold text-center">
                        Danh sách <br />
                        Thiếu nhi <br> Thánh Thể
                    </h1>
                    <div>
                        <input type="text" v-model="searchLastName">
                        <p class="mt-2 text-red-600">Tìm kiếm theo tên thiếu nhi</p>
                    </div>
                    <div class="ml-4">
                        <select
                            v-model="selectedAcademyYear"
                            class="cursor-pointer block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        >
                            <option value="">Tất cả niên khóa</option>
                            <option
                                v-for="uniqueAcademyYear in Array.from(
                                    new Set(
                                        children.map(
                                            (child) => child.academy_year
                                        )
                                    )
                                )"
                            >
                                {{ uniqueAcademyYear }}
                            </option>
                        </select>
                    </div>
                    <div class="ml-4">
                        <select
                            v-model="selectedStrawberry"
                            class="cursor-pointer block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        >
                            <option value="">Tất cả Giáo xóm</option>
                            <option
                                v-for="uniqueStrawberry_church in Array.from(
                                    new Set(
                                        children.map(
                                            (child) => child.strawberry_church
                                        )
                                    )
                                )"
                            >
                                {{ uniqueStrawberry_church }}
                            </option>
                        </select>
                    </div>
                    <div
                        @click="handleExport()"
                        class="cursor-pointer bg-slate-300 rounded-xl p-2 flex justify-center items-center"
                    >
                        <p class="text-red-500">Export Excel File</p>
                    </div>
                    <div
                        @click="handleImport()"
                        class="cursor-pointer bg-slate-300 rounded-xl p-2 flex justify-center items-center"
                    >
                        <p class="text-red-500">Import Excel File</p>
                    </div>
                </div>
                <div class="table-list pt-4 mt-10">
                    <table class="w-full -mt-4 table-auto">
                        <thead>
                            <tr class="text-center z-10">
                                <th>Tên Thánh và Họ</th>
                                <th>Tên</th>
                                <th>Ngày Sinh</th>
                                <th>Giới tính</th>
                                <th>Giáo Xóm</th>
                                <th>Giáo xứ</th>
                                <th>Niên Khóa</th>
                                <th>Bố Mẹ</th>
                                <th>SDT Phụ huynh</th>
                                <th>Điểm giữa học kỳ 1</th>
                                <th>Điểm học kỳ 1</th>
                                <th>Điểm giữa học kỳ 2</th>
                                <th>Điểm học kỳ 2</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="child in filteredChildren"
                                :key="child.id"
                                class="text-center mt-2 text-red-600"
                            >
                                <td>{{ child.first_name }}</td>
                                <td>{{ child.last_name }}</td>
                                <td>{{ child.birth_date }}</td>
                                <td>{{ child.gender }}</td>
                                <td>{{ child.strawberry_church }}</td>
                                <td>{{ child.parish }}</td>
                                <td>{{ child.academy_year }}</td>
                                <td>{{ child.parents }}</td>
                                <td>{{ child.phone_number }}</td>
                                <td>{{ child.mid_semester_1 }}</td>
                                <td>{{ child.semester_1 }}</td>
                                <td>{{ child.mid_semester_2 }}</td>
                                <td>{{ child.semester_2 }}</td>
                                <td>
                                    <button @click="handleDelete(child.id)">
                                        Delete
                                    </button>
                                    <button
                                        @click="handleEditChildren(child.id)"
                                        class="ml-4"
                                    >
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Toastify from "toastify-js";
export default {
    data() {
        return {
            children: [],
            selectedAcademyYear: "",
            selectedStrawberry: "",
            searchLastName: "",
        };
    },
    created() {
        this.fetchChildren();
    },

    methods: {
        fetchChildren() {
            axios
                .get("/api/children")
                .then((response) => {
                    this.children = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        async handleDelete(itemId) {
            try {
                await axios.delete(`/api/children/${itemId}`);
                Toastify({
                    text: "Delete category successfully!",
                    duration: 3000,
                    gravity: "top",
                    backgroundColor: "green",
                    stopOnFocus: true,
                }).showToast();
                this.fetchChildren();
            } catch (error) {
                console.error(error);
                Toastify({
                    text: "Fail delete category successfully!",
                    duration: 3000,
                    gravity: "top",
                    backgroundColor: "red",
                    stopOnFocus: true,
                }).showToast();
            }
        },
        handleCreate() {
            window.location.href = `/children/create`;
        },
        handleEditChildren(itemId) {
            window.location.href = `/children/edit/${itemId}`;
        },
        handleExport() {
            if (this.selectedCategory) {
                window.location.href = `/children/export-hotels/${this.selectedCategory}`;
            } else {
                window.location.href = `/children/export`;
            }
        },
        handleImport() {
            window.location.href = `/children/excel-csv-file`;
        },
    },
    computed: {
        filteredChildren() {
            if (
                !this.selectedAcademyYear &&
                !this.selectedStrawberry &&
                !this.searchLastName
            ) {
                return this.children;
            }

            return this.children.filter((child) => {
                const matchAcademyYear =
                    !this.selectedAcademyYear ||
                    child.academy_year === this.selectedAcademyYear;
                const matchStrawberry =
                    !this.selectedStrawberry ||
                    child.strawberry_church === this.selectedStrawberry;
                const matchLastName =
                    !this.searchLastName ||
                    child.last_name
                        .toLowerCase()
                        .includes(this.searchLastName.toLowerCase());

                return matchAcademyYear && matchStrawberry && matchLastName;
            });
        },
    },
};
</script>
<style>
table {
    border-collapse: collapse;
}
table,
th,
td {
    border: 1px solid;
}
.table-list {
    overflow-y: auto;
    height: 350px;
}
thead th {
    position: sticky;
    top: -20px;
    background-color: #f2f2f2;
}
</style>
