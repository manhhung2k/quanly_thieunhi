<template>
    <div class="all_create h-screen flex justify-center items-center">
        <div
            class="bg-white w-1/2 flex justify-center items-center p-6 rounded-3xl shadow-lg shadow-orange-900"
        >
            <div class="w-2/3">
                <h1 class="text-red-300 text-3xl font-bold text-center">
                    Hotel Create
                </h1>
                <form @submit.prevent="handleSubmit">
                    <div class="mt-3">
                        <input
                            type="file"
                            ref="fileInput"
                            @change="onFileChange"
                        />
                        <div v-if="selectedFile" class="mt-2">
                            <img
                                :src="imagePreview"
                                alt="Preview"
                                style="max-width: 200px"
                            />
                            <button @click="removeImage" class="mt-2">
                                Remove Image
                            </button>
                        </div>
                        <p v-if="errors.image" class="text-red-500">
                            {{ errors.image[0] }}
                        </p>
                    </div>
                    <div class="mt-3">
                        <label for="name">Name:</label>
                        <input type="text" id="name" v-model="hotel.name" />
                        <p v-if="errors.name" class="text-red-500">
                            {{ errors.name[0] }}
                        </p>
                    </div>
                    <div>
                        <label for="code">Code:</label>
                        <input type="text" id="code" v-model="hotel.code" />
                        <p v-if="errors.code" class="text-red-500">
                            {{ errors.code[0] }}
                        </p>
                    </div>
                    <div>
                        <label for="price_max">Price Max:</label>
                        <input
                            type="text"
                            id="price_max"
                            v-model="hotel.price_max"
                        />
                        <p v-if="errors.price_max" class="text-red-500">
                            {{ errors.price_max[0] }}
                        </p>
                    </div>
                    <div>
                        <label for="price_max">Price Min:</label>
                        <input
                            type="text"
                            id="price_max"
                            v-model="hotel.price_min"
                        />
                        <p v-if="errors.price_min" class="text-red-500">
                            {{ errors.price_min[0] }}
                        </p>
                    </div>
                    <div class="flex gap-6 mt-3">
                        <div class="float-left">
                            <label for="category" class="mr-2">Category:</label>
                            <select v-model="hotel.category_id" class="w-24">
                                <option
                                    v-for="category in categories"
                                    :value="category.id"
                                    :key="category.id"
                                    class="p-2 w-11"
                                >
                                    {{ category.name }}
                                </option>
                            </select>
                            <p v-if="errors.category_id" class="text-red-500">
                                {{ errors.category_id[0] }}
                            </p>
                        </div>
                        <div class="float-right">
                            <label for="sale_day">Sale day:</label>
                            <input
                                class="ml-3"
                                type="date"
                                id="price_max"
                                v-model="hotel.sale_day"
                            />
                            <p v-if="errors.sale_day" class="text-red-500">
                                {{ errors.sale_day[0] }}
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-center items-center mt-8 gap-4">
                        <button type="submit">Submit</button>
                        <button type="submit" @click="handleClose()">
                            Close
                        </button>
                    </div>
                </form>
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
            hotel: {
                name: "",
                code: "",
                price_max: "",
                price_min: "",
                category_id: null,
                image: null,
            },
            categories: [],
            errors: {},
            selectedFile: null,
        };
    },
    created() {
        this.fetchCategories();
    },
    computed: {
        imagePreview() {
            return this.selectedFile
                ? URL.createObjectURL(this.selectedFile)
                : null;
        },
    },
    methods: {
        onFileChange(event) {
            this.selectedFile = event.target.files[0];
        },
        removeImage() {
            this.selectedFile = null;
        },
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
        handleSubmit() {
            let formData = new FormData();
            formData.append("name", this.hotel.name);
            formData.append("code", this.hotel.code);
            formData.append("price_max", this.hotel.price_max);
            formData.append("price_min", this.hotel.price_min);
            formData.append("category_id", this.hotel.category_id);
            formData.append("image", this.selectedFile);
            formData.append("sale_day", this.hotel.sale_day);
            axios
                .post("/api/hotel/create", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data", // Cần đặt header này khi gửi FormData chứa file
                    },
                })
                .then((response) => {
                    Toastify({
                        text: "Add category successfully!",
                        duration: 3000, // Thời gian hiển thị thông báo (3 giây)
                        gravity: "top", // Vị trí hiển thị thông báo (top hoặc bottom)
                        backgroundColor: "green", // Màu nền của thông báo
                        stopOnFocus: true, // Dừng hiển thị thông báo khi người dùng tương tác với trang
                    }).showToast();
                    this.category = response.data;
                    console.log(response.data);
                    this.category.name = "";
                    this.category.code = "";
                    this.category.description = "";
                    window.location.href = `/hotel`;
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.error(error);
                        Toastify({
                            text: "Failed add category successfully!",
                            duration: 3000, // Thời gian hiển thị thông báo (3 giây)
                            gravity: "top", // Vị trí hiển thị thông báo (top hoặc bottom)
                            backgroundColor: "red", // Màu nền của thông báo
                            stopOnFocus: true, // Dừng hiển thị thông báo khi người dùng tương tác với trang
                        }).showToast();
                    }
                });
        },
        handleClose() {
            window.location.href = `/hotel`;
        },
    },
};
</script>
<style>
label {
    margin-top: 8px;
    color: #493527;
}
input[type="text"] {
    margin-top: 5px;
    padding: 5px;
    border: 1px solid #33ffff;
}
button[type="submit"] {
    background-color: #00ffff;
    border: #00ffff;
    color: #ddb192;
}
button[type="text"]:hover {
    background-color: #ddb192;
    color: brown;
}
option {
    border: 1px solid #33ffff;
}
</style>
