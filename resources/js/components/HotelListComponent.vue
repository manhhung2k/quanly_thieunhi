<template>
    <div class="all_create h-screen flex justify-center items-center">
        <div
            class="bg-white w-2/3 flex justify-center items-center p-6 rounded-3xl shadow-lg shadow-orange-900"
        >
            <div class="w-full">
                <div class="flex gap-10 px-6 w-2/3 mx-auto">
                    <div @click="handleCreate()" class="cursor-pointer bg-slate-400 rounded-xl p-2">
                        <p class="text-red-500">Create Hotel</p>
                    </div>
                    <h1 class="text-red-300 text-3xl font-bold text-center">Hotel List</h1>
                    <div class="w-1/3 ml-4 relative">
                        <select v-model="selectedCategory" class="cursor-pointer block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">All Categories</option>
                            <option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9 12l4-4-4-4V1H7v7H2v2h5v7l4-4z"/></svg>
                        </div>
                    </div> 
                </div>

                <table class="w-full mt-4 table-auto">
                    <tr class="text-center">
                        <th>Name</th>
                        <th>Code</th>
                        <th>Price Max</th>
                        <th>Price Min</th>
                        <th>Category</th>
                        <th>Sale Day</th>
                        <th>Option</th>
                    </tr>
                    <tr v-for="hotel in filteredHotels" :key="hotel.id" class="text-center mt-2 text-red-600">
                        <td>{{ hotel.name }}</td>
                        <td>{{ hotel.code }}</td>
                        <td>{{ hotel.price_max }}</td>
                        <td>{{ hotel.price_min }}</td>
                        <td>{{ hotel.category.name }}</td>
                        <td>{{ hotel.sale_day }}</td>
                        <td>
                            <button @click="handleDelete(hotel.id)">
                                Delete
                            </button>
                            <button @click="handleEditHotel(hotel.id)" class="ml-4">
                                Edit
                            </button>
                        </td>
                    </tr>
                </table>
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
            hotels: [],
            categories: [],
            selectedCategory: "",
        };
    },
    created() {
        this.fetchHotels();
        this.fetchCategories();
    },
    methods: {
        fetchCategories() {
            axios
                .get("/api/category")
                .then((response) => {
                    this.categories = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        fetchHotels() {
            axios
                .get("/api/hotel")
                .then((response) => {
                    this.hotels = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        async handleDelete(itemId) {
            try {
                await axios.delete(`/api/hotel/${itemId}`);
                Toastify({
                    text: "Delete category successfully!",
                    duration: 3000, // Thời gian hiển thị thông báo (3 giây)
                    gravity: "top", // Vị trí hiển thị thông báo (top hoặc bottom)
                    backgroundColor: "green", // Màu nền của thông báo
                    stopOnFocus: true, // Dừng hiển thị thông báo khi người dùng tương tác với trang
                }).showToast();
                this.fetchHotels();
            } catch (error) {
                console.error(error);
                Toastify({
                    text: "Fail delete category successfully!",
                    duration: 3000, // Thời gian hiển thị thông báo (3 giây)
                    gravity: "top", // Vị trí hiển thị thông báo (top hoặc bottom)
                    backgroundColor: "red", // Màu nền của thông báo
                    stopOnFocus: true, // Dừng hiển thị thông báo khi người dùng tương tác với trang
                }).showToast();
            }
        },
        handleCreate() {
            window.location.href = `/hotel/create`;
        },
        handleEditHotel(itemId) {
            // Chuyển hướng tới trang edit bằng Laravel route
            window.location.href = `/hotel/edit/${itemId}`;
        },
    },
    computed: {
        filteredHotels() {
            // Nếu không có category được chọn (selectedCategory rỗng), hiển thị tất cả khách sạn
            if (!this.selectedCategory) {
                return this.hotels;
            }
            // Nếu có category được chọn, lọc danh sách khách sạn theo category
            return this.hotels.filter((hotel) => hotel.category.id === this.selectedCategory);
        },
    },
};
</script>
<style>
table {
    border-collapse: collapse;
}
table, th, td {
    border: 1px solid;
  }
</style>
