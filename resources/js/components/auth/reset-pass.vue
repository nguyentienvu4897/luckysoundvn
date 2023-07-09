<template>
<div>
    <div class="header bg-gradient-success py-7 py-lg-8 pt-lg-9">
    <div class="container">
        <div class="header-body text-center mb-7">
        <div class="text-center" style="margin-bottom: 5px; margin-top: -3px">
            <h3 class="">
            Chào mừng bạn đến với trang đổi mật khẩu
            </h3>
            <p class="text-lead">
            Toàn bộ thông tin của website của bạn đều được chúng tôi bảo mật tuyệt đối. Trang quản trị này chỉ dành riêng cho bạn. Hãy nhập mật khẩu cũ để xác minh và cập nhật mật khẩu mới
            </p>
        </div>
        </div>
    </div>
    </div>
    <div class="col-md-4 ml-auto mr-auto" style="margin-top: 35px">
    <form>
        <card class="card-login card-plain">
        <div>
            <vs-input
                    class="w-100"
                    v-model="objLogin.old_pass"
                    font-size="40px"
                    type="text"
                    label-placeholder="Mật khẩu cũ"
                    style="margin-bottom: 30px"
            />
            <vs-input
                    class="w-100"
                    v-model="objLogin.new_pass"
                    font-size="40px"
                    type="text"
                    label-placeholder="Mật khẩu mới"
            />
        </div>
        <div slot="footer">
            <button @click="change" class="btn btn-primary"  style="width:100%">
            Đổi mật khẩu
            </button>
        </div>
        </card>
    </form>
    </div>
</div>
</template>

<script>
import axios from "axios";
import { mapActions } from "vuex";
export default {
data() {
    return {
    objLogin: {
        old_pass: "",
        new_pass: "",
    },
    };
},
methods: {
    ...mapActions(["changePass", "loadings",'destroyToken']),
    change() {
    this.loadings(true);
    this.changePass(this.objLogin)
        .then((response) => {
        this.loadings(false);
        this.$success('Đổi mật khẩu thành công');
        this.destroyToken().then(response => {
            this.loadings(false)
            this.$router.push({ name: "login" })
        }).catch(error => {
            this.loadings(false);
            this.$router.push({ name: "login" })
        })
        })
        .catch((error) => {
        this.loadings(false);
        this.$error("Đổi mật khẩu thất bại");
        });
    },
},
created() {},
};
</script>

