<template>
    <div class="all_create h-screen flex justify-center items-center">
        <div
            class="bg-white w-1/2 flex justify-center items-center p-6 rounded-3xl shadow-lg shadow-orange-900"
        >
            <div class="">
                <h1 class="text-red-300 text-3xl font-bold text-center">
                    Chỉnh sửa thông tin của Thiếu nhi Thánh Thể
                </h1>
                <form @submit.prevent="handleUpdate()">
                    <div class="flex gap-28">
                        <div>
                            <div class="mt-3">
                                <label for="first_name">Tên Thánh và Họ:</label><br>
                                <input
                                    type="text"
                                    id="name"
                                    v-model="editedChildren.first_name"
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
                                    v-model="editedChildren.last_name"
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
                                    id="code"
                                    v-model="editedChildren.birth_date"
                                />

                            </div>
                            <div>
                                <label for="gender">Giới tính:</label>
                                <select id="gender" v-model="editedChildren.gender">
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
                                    v-model="editedChildren.strawberry_church"
                                />

                            </div>
                            <div>
                                <label for="parish">Giáo xứ:</label><br>
                                <input
                                    type="text"
                                    id="parish"
                                    v-model="editedChildren.parish"
                                />

                            </div>
                            <div>
                                <label for="academy_year">Niên khóa:</label><br>
                                <input
                                    type="text"
                                    id="academy_year"
                                    v-model="editedChildren.academy_year"
                                />

                            </div>
                            <div class="">
                                <div class="">
                                    <label for="parents">Bố mẹ:</label><br>
                                    <input
                                        class=""
                                        type="text"
                                        id="parents"
                                        v-model="editedChildren.parents"
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
                                        v-model="editedChildren.phone_number"
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
                                    v-model="editedChildren.mid_semester_1"
                                />

                            </div>
                            <div class="mt-3">
                                <label for="semester_1">Điểm học kỳ 1:</label><br>
                                <input
                                    type="text"
                                    id="semester_1"
                                    v-model="editedChildren.semester_1"
                                />

                            </div>
                            <div class="mt-3">
                                <label for="mid_semester_2"
                                    >Điểm giữa học kỳ 2:</label
                                ><br>
                                <input
                                    type="text"
                                    id="mid_semester_2"
                                    v-model="editedChildren.mid_semester_2"
                                />

                            </div>
                            <div class="mt-3">
                                <label for="semester_2">Điểm học kỳ 2:</label><br>
                                <input
                                    type="text"
                                    id="semester_2"
                                    v-model="editedChildren.semester_2"
                                />

                            </div>
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
    props: ["children"],
    data() {
        return {
            editedChildren: { ...this.children },
            errors: {},
        };
    },
    methods: {
        handleUpdate() {
            const itemId = this.children.id;
            axios
            .post(`/api/children/update/${itemId}`, this.editedChildren)
                .then(() => {
                    Toastify({
                        text: "Chỉnh sửa thông tin thành công!",
                        duration: 3000,
                        gravity: "top",
                        backgroundColor: "green",
                        stopOnFocus: true,
                    }).showToast();
                    window.location.href = `/children`;
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.error(error);
                        Toastify({
                            text: "Lỗi chỉnh sửa thông tin!",
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
