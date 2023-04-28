<template>
  <div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-3"><h4 class="card-title">Sửa danh mục sản phẩm</h4></div>
                <div class="col-md-6"></div>
                <div class="col-md-3">
                  </div>
              </div>
              
              
              <!-- <p class="card-description">Basic form elements</p> -->
              <form class="forms-sample">
                <div class="form-group">
                <label>Tên</label>
                  <vs-input
                    class="w-100"
                    v-model="objData.name[0].content"
                    font-size="40px"
                  />
                </div>
                <div class="form-group">
                <label>Tiêu đề ở trang chủ</label>
                  <vs-input
                    class="w-100"
                    v-model="objData.home_title"
                    font-size="40px"
                  />
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Ảnh đại diện</label>
                      <image-upload
                        v-model="objData.avatar"
                        type="avatar"
                        :title="'danh-muc'"
                      ></image-upload>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Banner danh mục</label>
                      <image-upload
                        v-model="objData.banner_1"
                        type="avatar"
                        :title="'banner-danh-muc'"
                      ></image-upload>
                    </div>
                    <div class="form-group">
                      <vs-input
                        class="w-100"
                        v-model="objData.path_1"
                        font-size="40px"
                        label-placeholder="Link banner 1"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Banner danh mục</label>
                      <image-upload
                        v-model="objData.banner_2"
                        type="avatar"
                        :title="'banner-danh-muc'"
                      ></image-upload>
                    </div>
                    <div class="form-group">
                      <vs-input
                        class="w-100"
                        v-model="objData.path_2"
                        font-size="40px"
                        label-placeholder="Link banner 2"
                      />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                <label>Nội dung</label>
                 <TinyMce v-model="objData.content" />
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputName1">Hiển thị trên thanh menu</label>
                      <vs-select v-model="objData.status"
                      >
                          <vs-select-item  value="1" text="Hiện" />
                          <vs-select-item  value="0" text="Ẩn" />
                        </vs-select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputName1">Hiển thị danh mục sản phẩm trang chủ</label>
                      <vs-select v-model="objData.quiz_id"
                      >
                          <vs-select-item  value="1" text="Hiện" />
                          <vs-select-item  value="0" text="Ẩn" />
                        </vs-select>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row fixxed">
        <div class="col-12">
          <div class="saveButton">
            <vs-button color="primary" @click="saveEdit()">Cập nhật</vs-button>
          </div>
        </div>
      </div>
    <!-- content-wrapper ends -->
  </div>
</template>

<script>
import { mapActions } from "vuex";
import TinyMce from "../_common/tinymce";
export default {
  data() {
    return {
      showLang:{
        title:false
      },
      objData: {
        id:this.$route.params.id,
        name: [
          {
            lang_code:'vi',
            content:''
          }
        ],
        content: "",
        avatar: "",
        home_title: "",
        status: "",
        quiz_id: "",
        path_1: "",
        path_2: "",
        banner_1: "",
        banner_2: "",
      },
      lang:[],
      img: "",
      errors:[]
    };
  },
  components: {
    TinyMce,
  },
  methods: {
    ...mapActions(["getInfoCate","saveCategory","listLanguage", "loadings"]),
    nameImage(event) {
      this.objData.avatar = event;
    },
    showSettingLangExist(value){
        this.showLang.title = !this.showLang.title
          this.lang.forEach((value, index) => {
              if(!this.objData.name[index] && value.code != this.objData.name[0].lang_code){
                  var oj = {};
                  oj.lang_code = value.code;
                  oj.content = ''
                  this.objData.name.push(oj)
              }
          });
    },
    saveEdit() {
      this.errors = [];
      if(this.objData.name[0].content == '') this.errors.push('Tên danh mục không được để trống');
      if(this.objData.home_title == '') this.errors.push('Tiêu đề trang chủ không được để trống');
      if(this.objData.avatar == '') this.errors.push('Cập nhật ảnh đại diện danh mục');
      if(this.objData.banner_1 == '') this.errors.push('Cập nhật banner danh mục');
      if(this.objData.banner_2 == '') this.errors.push('Cập nhật banner danh mục');
      if (this.errors.length > 0) {
        this.errors.forEach((value, key) => {
          this.$error(value)
        })
        return;
      } else {
        this.loadings(true);
        this.saveCategory(this.objData)
        .then(response => {
            this.loadings(false);
            this.$router.push({ name: "list_category" });
            this.$success("Sửa danh mục thành công");
            this.$route.push({ name: "list_category" });
          })
          .catch(error => {
            this.loadings(false);
            // this.$error('Sửa danh mục thất bại');
          });
      }
    },
    listLang(){
      this.listLanguage().then(response => {
        this.loadings(false);
        this.lang  = response.data
      }).catch(error => {

      })
    },
    getInfoCates(){
      this.loadings(true);
      this.getInfoCate(this.objData).then(response => {
        this.loadings(false);
        if(response.data == null){
          this.objData ={
            id:this.$route.params.id,
            name: "",
            path_1: "",
            path_2: "",
            banner_1: "",
            banner_2: "",
            avatar: "",
            status: "",
          }
        }else{
          this.objData = response.data;
          this.objData.name = JSON.parse(response.data.name);
        }
      }).catch(error => {
        console.log(12);
      });
    },
    changeLanguage(data){
      this.getInfoCates();
    }
  },
  mounted() {
    this.loadings(true);
    this.getInfoCates();
    this.listLang();
  }
};
</script>

<style>
</style>