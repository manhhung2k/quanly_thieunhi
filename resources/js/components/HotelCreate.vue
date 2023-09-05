<template>
    <div class="all_create h-screen flex justify-center items-center">
        <div
            class="bg-white w-1/2 flex justify-center items-center p-6 rounded-3xl shadow-lg shadow-orange-900 -mt-24"
        >
            <div class="">
                <h1 class="text-red-300 text-3xl font-bold text-center">
                    Thêm thiếu nhi vào danh sách
                </h1>
                <form @submit.prevent="handleSubmit">
                    <div class="flex gap-28">
                        <div>
                            <div class="mt-3">
                                <label for="first_name">Tên Thánh và Họ:</label><br>
                                <input
                                    type="text"
                                    id="name"
                                    v-model="children.first_name"
                                />
                                <p
                                    v-if="errors.first_name"
                                    class="text-red-500"
                                >
                                    {{ errors.first_name[0] }}
                                </p>
                            </div>
                            <div class="mt-3">
                                <label for="last_name">Tên:</label><br>
                                <input
                                    type="text"
                                    id="name"
                                    v-model="children.last_name"
                                />
                                <p
                                    v-if="errors.last_name"
                                    class="text-red-500"
                                >
                                    {{ errors.last_name[0] }}
                                </p>
                            </div>
                            <div>
                                <label for="birth_date"
                                    >Ngày tháng năm sinh:</label
                                ><br>
                                <input
                                    type="date"
                                    id="birth_date"
                                    name="birth_date"
                                    v-model="children.birth_date"
                                />

                            </div>
                            <div>
                                <label for="gender">Giới tính:</label>
                                <select id="gender" v-model="children.gender">
                                  <option value="other">Other</option>
                                  <option value="nam">Nam</option>
                                  <option value="nu">Nữ</option>
                                </select>

                              </div>
                        </div>
                        <div>
                            <div>
                                <label for="strawberry_church">Giáo xóm:</label><br>
                                <input
                                    type="text"
                                    id="strawberry_church"
                                    v-model="children.strawberry_church"
                                />

                            </div>
                            <div>
                                <label for="parish">Giáo xứ:</label><br>
                                <input
                                    type="text"
                                    id="parish"
                                    v-model="children.parish"
                                />

                            </div>
                            <div>
                                <label for="academy_year">Niên khóa:</label><br>
                                <input
                                    type="text"
                                    id="academy_year"
                                    v-model="children.academy_year"
                                />

                            </div>
                            <div class="">
                                <div class="">
                                    <label for="parents">Bố mẹ:</label><br>
                                    <input
                                        class=""
                                        type="text"
                                        id="parents"
                                        v-model="children.parents"
                                    />

                                </div>
                            </div>
                            <div class="">
                                <div class="">
                                    <label for="phone_number"
                                        >Số điện thoại:</label
                                    ><br>
                                    <input
                                        class=""
                                        type="text"
                                        id="phone_number" maxlength="10"
                                        v-model="children.phone_number"
                                    />

                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="mt-3">
                                <label for="mid_semester_1"
                                    >Điểm giữa học kỳ 1:</label
                                ><br>
                                <input
                                    type="text"
                                    id="mid_semester_1"
                                    v-model="children.mid_semester_1"
                                />

                            </div>
                            <div class="mt-3">
                                <label for="semester_1">Điểm học kỳ 1:</label><br>
                                <input
                                    type="text"
                                    id="semester_1"
                                    v-model="children.semester_1"
                                />

                            </div>
                            <div class="mt-3">
                                <label for="mid_semester_2"
                                    >Điểm giữa học kỳ 2:</label
                                ><br>
                                <input
                                    type="text"
                                    id="mid_semester_2"
                                    v-model="children.mid_semester_2"
                                />

                            </div>
                            <div class="mt-3">
                                <label for="semester_2">Điểm học kỳ 2:</label><br>
                                <input
                                    type="text"
                                    id="semester_2"
                                    v-model="children.semester_2"
                                />

                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center items-center mt-8 gap-16">
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
            children: {
                first_name: "",
                last_name: "",
                gender: "",
                birth_date: "",
                strawberry_church: "",
                parish: "",
                academy_year: "",
                parents: "",
                phone_number: "",
                mid_semester_1: "",
                semester_1: "",
                mid_semester_2: "",
                semester_2: "",
            },
            errors: {},
        };
    },
    methods: {
        handleSubmit() {
            let formData = new FormData();
            formData.append("first_name", this.children.first_name);
            formData.append("last_name", this.children.last_name);
            formData.append("birth_date", this.children.birth_date);
            formData.append("gender", this.children.gender);

            formData.append(
                "strawberry_church",
                this.children.strawberry_church
            );
            formData.append("parish", this.children.parish);

            formData.append("academy_year", this.children.academy_year);
            formData.append("parents", this.children.parents);
            formData.append("phone_number", this.children.phone_number);

            formData.append("mid_semester_1", this.children.mid_semester_1);
            formData.append("semester_1", this.children.semester_1);
            formData.append("mid_semester_2", this.children.mid_semester_2);
            formData.append("semester_2", this.children.semester_2);
            axios
                .post("/api/children/create", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    Toastify({
                        text: "Add Children successfully!",
                        duration: 3000,
                        gravity: "top",
                        backgroundColor: "green",
                        stopOnFocus: true,
                    }).showToast();
                    console.log(response.data);
                    window.location.href = `/children`;
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.error(error);
                        Toastify({
                            text: "Failed add Children!",
                            duration: 3000,
                            gravity: "top",
                            backgroundColor: "red",
                            stopOnFocus: true,
                        }).showToast();
                    }
                });
        },
        handleClose() {
            window.location.href = `/children`;
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
    padding: 5px 10px;
    border: 1px solid #33ffff;
    border-radius: 15px;
}
button[type="submit"] {
    background-image: linear-gradient(yellow, red);
    border: #00ffff;
    color: black;
    border-radius: 20px;
    height: 50px;
    width: 80px;
}
button[type="text"]:hover {
    background-color: #ddb192;
    color: brown;
}
option {
    border: 1px solid #33ffff;
}
</style>
