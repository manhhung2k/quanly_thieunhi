<template>
    <div class="all_create h-screen flex justify-center items-center">
        <div
            class="bg-white w-1/2 flex justify-center items-center p-6 rounded-3xl shadow-lg shadow-orange-900"
        >
            <div class="w-2/3">
                <h1 class="text-red-300 text-3xl font-bold text-center">
                    Category Edit
                </h1>
                <form @submit.prevent="handleUpdate()">
                    <div>
                        <label for="name">Name:</label>
                        <input
                            type="text"
                            id="name"
                            v-model="editedCategory.name"
                        />
                        <p v-if="errors.name" class="text-red-500">
                            {{ errors.name[0] }}
                        </p>
                    </div>
                    <div>
                        <label for="name">Code:</label>
                        <input
                            type="text"
                            id="name"
                            v-model="editedCategory.code"
                        />
                        <p v-if="errors.code" class="text-red-500">
                            {{ errors.code[0] }}
                        </p>
                    </div>
                    <div>
                        <label for="name">Description:</label>
                        <input
                            type="text"
                            id="name"
                            v-model="editedCategory.description"
                        />
                        <p v-if="errors.description" class="text-red-500">
                            {{ errors.description[0] }}
                        </p>
                    </div>
                    <div class="flex justify-center items-center mt-8 gap-8">
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
    props: ["categories"],
    data() {
        return {
            editedCategory: { ...this.categories },
            errors: {},
        };
    },
    methods: {
        handleUpdate() {
            const itemId = this.categories.id;
            axios
                .post(`/api/category/update/${itemId}`, this.editedCategory)
                .then(() => {
                    Toastify({
                        text: "Edit category successfully!",
                        duration: 3000,
                        gravity: "top",
                        backgroundColor: "green",
                        stopOnFocus: true,
                    }).showToast();
                    window.location.href = `/category`;
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
            window.location.href = `/category`;
        },
    },
};
</script>
