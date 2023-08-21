<template>
    <div class="all_create h-screen flex justify-center items-center">
        <div
            class="bg-white w-1/2 flex justify-center items-center p-6 rounded-3xl shadow-lg shadow-orange-900"
        >
            <div class="w-2/3">
                <h1 class="text-red-300 text-3xl font-bold text-center">
                    Hotel Edit
                </h1>
                <form @submit.prevent="handleUpdate()">
                    <div class="mt-3">
                        <input
                            type="file"
                            ref="fileInput"
                            @change="onFileChange"
                        />
                        <img
                            v-if="imageUrl"
                            :src="'/images/' + editedHotel.image"
                            alt="Image"
                            style="max-width: 200px; margin-top: 10px"
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
                            <p v-if="errors.image" class="text-red-500">
                                {{ errors.image[0] }}
                            </p>
                        </div>

                    </div>
                    <div>
                        <label for="name">Name:</label>
                        <input
                            type="text"
                            id="name"
                            v-model="editedHotel.name"
                        />
                        <p v-if="errors.name" class="text-red-500">
                            {{ errors.name[0] }}
                        </p>
                    </div>
                    <div>
                        <label for="code">Code:</label>
                        <input
                            type="text"
                            id="code"
                            v-model="editedHotel.code"
                        />
                        <p v-if="errors.code" class="text-red-500">
                            {{ errors.code[0] }}
                        </p>
                    </div>
                    <div>
                        <label for="price_max">Price Max:</label>
                        <input
                            type="text"
                            id="price_max"
                            v-model="editedHotel.price_max"
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
                            v-model="editedHotel.price_min"
                        />
                        <p v-if="errors.price_min" class="text-red-500">
                            {{ errors.price_min[0] }}
                        </p>
                    </div>
                    <div class="flex gap-6 mt-3">
                        <div class="float-left">
                            <label for="category" class="mr-2">Category:</label>
                            <select
                                v-model="editedHotel.category_id"
                                class="w-24"
                            >
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
                                type="date"
                                id="price_max"
                                v-model="editedHotel.sale_day"
                                class="ml-3"
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
    props: ["hotels", "categories"],
    data() {
        return {
            editedHotel: { ...this.hotels, ...this.categories },
            categories: [],
            errors: {},
            imageUrl: "",
            selectedFile: "",
        };
    },
    created() {
        this.fetchCategories();
        this.imageUrl = "/images/" + this.editedHotel.image;
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
            this.imageUrl = "";
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
        handleUpdate() {
            const itemId = this.hotels.id;
            let formData = new FormData();
            formData.append("name", this.editedHotel.name);
            formData.append("code", this.editedHotel.code);
            formData.append("price_max", this.editedHotel.price_max);
            formData.append("price_min", this.editedHotel.price_min);
            formData.append("category_id", this.editedHotel.category_id);
            if (!this.selectedFile) {
                formData.append("image_1", this.editedHotel.image);
            } else {
                formData.append("image", this.selectedFile);
            }

            formData.append("sale_day", this.editedHotel.sale_day);
            axios
                .post(`/api/hotel/update/${itemId}`, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data", 
                    },
                })
                .then(() => {
                    Toastify({
                        text: "Edit category successfully!",
                        duration: 3000,
                        gravity: "top",
                        backgroundColor: "green",
                        stopOnFocus: true,
                    }).showToast();
                    window.location.href = `/hotel`;
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.error(error);
                        Toastify({
                            text: "Failed edit category!",
                            duration: 3000,
                            gravity: "top",
                            backgroundColor: "red",
                            stopOnFocus: true,
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
