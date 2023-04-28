<template>
  <div>
      <h3 class="page-title">Quản lý chi nhánh</h3>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body" >
              <div class="row" v-for="(item, key) in objData" :key="key">
                <div class="col-md-3">
                  <div class="form-group">
                    <image-upload type="avatar" v-model="item.image" :title="'tieu-chi'"></image-upload>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label>Tên, địa chỉ và sđt chi nhánh</label>
                    <label style="float: right;cursor: pointer" title="Xóa chi nhánh" v-if="key != 0" @click="removeObjPartner(key)">
                      <vs-icon icon="clear"></vs-icon>
                    </label>
                    <TinyMce v-model="item.name" />
                  </div>
                  <div class="form-group">
                    <label>Link map</label>
                    <vs-input
                      type="text"
                      v-model="item.link"
                      size="default"
                      placeholder="Link google map của chi nhánh"
                      class="w-100"
                    />
                  </div>
                  <div class="form-group">
                    <label>Trạng thái</label>
                    <vs-select v-model="item.status"
                  >
                      <vs-select-item  value="1" text="Hiện" />
                      <vs-select-item  value="0" text="Ẩn" />
                    </vs-select>
                  </div>
                </div>
                <hr style="border: 0.5px solid #04040426; width: 100%;">
              </div>
              <vs-button color="primary" @click="savePartners">Lưu</vs-button>
              <vs-button color="success" @click="addObjPartner">Thêm chi nhánh</vs-button>
            </div>
          </div>
        </div>
      </div>
    <!-- content-wrapper ends -->
  </div>
</template>


<script>
import { mapActions } from "vuex";
import { required } from "vuelidate/lib/validators";
import TinyMce from "../_common/tinymce";
export default {
  name: "product",
  data() {
    return {
      objData:[
        {
          name:"",
          image: "",
          status:"",
          link:""
        },
      ] 
    };
  },
  components: {
    TinyMce,
  },
  computed: {},
  watch: {},
  methods: {
    ...mapActions(["savePartner", "loadings","listPartner"]),
    savePartners(){
      this.loadings(true);
      this.savePartner({data:this.objData}).then(response => {
        this.loadings(false);
        this.$success('Thêm chi nhánh thành công');
      }).catch(error => {
        this.loadings(false);
        this.$error('Thêm chi nhánh thất bại');
      })
    },
    addObjPartner(){
      this.objData.push({
          name:"",
          image: "",
          status:"",
          link:""
        });
    },
    removeObjPartner(i){
      this.objData.splice(i, 1);
    },
    listBanners(){
      this.loadings(true);
      this.listPartner().then(response => {
        this.loadings(false);
        if(response.data.length > 0){
          this.objData = response.data
        }else{
          this.objData = [
            {
              name:"",
              image: "",
              status:"",
              link:""
            }
          ]
        }
        
      }).catch(error => {
        this.loadings(false);;
      })
    }
  },
  mounted() {
    this.listBanners();
  }
};
</script>