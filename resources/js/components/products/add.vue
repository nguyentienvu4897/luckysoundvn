<template>
    <div>
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="form-group">
                <label>Tên sản phẩm</label>
                <vs-input
                type="text"
                size="default"
                placeholder="Tên sản phẩm"
                class="w-100"
                v-model="objData.name[0].content"
                />
                <!-- <el-button size="small" @click="showSettingLangExist('name')"
                >Đa ngôn ngữ</el-button
                >
                <div class="dropLanguage" v-if="showLang.title == true">
                <div
                    class="form-group"
                    v-for="(item, index) in lang"
                    :key="index"
                >
                    <label v-if="index != 0">{{ item.name }}</label>
                    <input
                    v-if="index != 0"
                    type="text"
                    size="default"
                    placeholder="Tên sản phẩm"
                    class="w-100 inputlang"
                    v-model="objData.name[index].content"
                    />
                </div>
                </div> -->
            </div>
            <div class="form-group">
                <label>Nội dung</label>
                <TinyMce
                v-model="objData.content[0].content"
                />
                <!-- <el-button size="small" @click="showSettingLangExist('content')">Đa ngôn ngữ</el-button>
                <div class="dropLanguage" v-if="showLang.content == true">
                    <div class="form-group" v-for="item,index in lang" :key="index">
                        <label v-if="index != 0">{{item.name}}</label>
                        <TinyMce v-if="index != 0" v-model="objData.content[index].content" />
                    </div>
                </div> -->
            </div>
            <div class="form-group">
                <label>Mô tả ngắn</label>
                <TinyMce
                v-model="objData.description[0].content"
                />
                <!-- <el-button size="small" @click="showSettingLangExist('description')">Đa ngôn ngữ</el-button>
                <div class="dropLanguage" v-if="showLang.description == true">
                    <div class="form-group" v-for="item,index in lang" :key="index">
                        <label v-if="index != 0">{{item.name}}</label>
                        <TinyMce v-if="index != 0" v-model="objData.description[index].content" />
                    </div>
                </div> -->
            </div>
            <div class="form-group">
                <label>Ảnh sản phẩm</label>
                <ImageMulti v-model="objData.images" :title="'san-pham'"/>
            </div>
            <div class="form-group">
                <label>Giá Sản phẩm</label>
                <vs-input
                type="number"
                size="default"
                icon="all_inclusive"
                class="w-100"
                v-model="objData.price"
                />
            </div>
            <div class="form-group">
                <label>Phần trăm giảm giá</label>
                <vs-input
                type="number"
                size="default"
                icon="all_inclusive"
                class="w-100"
                v-model="objData.discount"
                />
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

            <div class="form-group">
                <label>Trạng thái</label>
                <vs-select v-model="objData.status">
                <vs-select-item value="1" text="Còn hàng" />
                <vs-select-item value="0" text="Hết hàng" />
                </vs-select>
            </div>

            <div class="form-group">
                <label>Danh mục sản phẩm</label>
                <vs-select
                class="selectExample"
                v-model="objData.category"
                placeholder="Danh mục"
                @change="findCategoryType()"
                >
                <vs-select-item
                    value="0"
                    text="Không danh mục"
                />
                <vs-select-item
                    :value="item.id"
                    :text="JSON.parse(item.name)[0].content"
                    v-for="(item, index) in cate"
                    :key="'f' + index"
                />
                </vs-select>
            </div>

            <div class="form-group">
                <label>Loại danh mục</label>
                <vs-select
                class="selectExample"
                v-model="objData.type_cate"
                placeholder="Loại"
                :disabled=" type_cate.length == 0"
                @change="findCategoryTypeTwo()"
                >
                <vs-select-item
                    value="0"
                    text="Không loại danh mục"
                />
                <vs-select-item
                    :value="item.id"
                    :text="JSON.parse(item.name)[0].content"
                    v-for="(item, index) in type_cate"
                    :key="'v' + index"
                />
                </vs-select>
            </div>

            <div class="form-group">
                <label>Thương hiệu sản phẩm</label>
                <vs-select
                class="selectExample"
                v-model="objData.brand_id"
                placeholder="Thương hiệu"
                :disabled="objData.cate == 0"
                >
                <vs-select-item
                    value="0"
                    text="Không thương hiệu"
                />
                <vs-select-item
                    :value="item.id"
                    :text="item.name"
                    v-for="(item, index) in brands"
                    :key="'v' + index"
                />
                </vs-select>
            </div>

            <div class="form-group">
                <label>Thuộc combo sản phẩm</label>
                <vs-select
                class="selectExample"
                v-model="objData.combo_id"
                placeholder="Combo"
                :disabled="objData.cate == 0"
                >
                <vs-select-item
                    value="0"
                    text="Không combo"
                />
                <vs-select-item
                    :value="item.id"
                    :text="item.name"
                    v-for="(item, index) in combo"
                    :key="'v' + index"
                />
                </vs-select>
            </div>

            <div class="form-group">
                <label>Thuộc gợi ý mua hàng trang chủ</label>
                <vs-select
                class="selectExample"
                v-model="objData.promotion_id"
                placeholder="Gợi ý mua hàng"
                :disabled="objData.cate == 0"
                >
                <vs-select-item
                    value="0"
                    text="Không gợi ý"
                />
                <vs-select-item
                    :value="item.id"
                    :text="item.name"
                    v-for="(item, index) in promotion"
                    :key="'v' + index"
                />
                </vs-select>
            </div>

            <div class="form-group">
                <label>Thông số kỹ thuật</label>
                <div v-for="(item, index) in objData.size" :key="index">
                <div class="row">
                    <div class="col-10">
                    <vs-input
                        type="text"
                        size="default"
                        :placeholder="'Tiêu đề ' + index"
                        class="w-100"
                        v-model="objData.size[index].title"
                    />
                    <vs-input
                        type="text"
                        size="default"
                        :placeholder="'Chi tiết ' + index"
                        class="w-100"
                        v-model="objData.size[index].detail"
                    />
                    <br />
                    </div>
                    <div class="col-2">
                    <a
                        href="javascript:;"
                        v-if="index != 0"
                        @click="remoteAr(index,'size')"
                    >
                        <img v-bind:src="'/media/' + joke.avatar" width="25" />
                    </a>
                    </div>
                </div>
                </div>

                <el-button size="small" @click="addInput('size')"
                >Thêm thông số</el-button
                >
            </div>
            <div class="form-group">
                <label>Thông tin khuyến mãi</label>
                <div v-for="(item, i) in objData.preserve" :key="i">
                <div class="row">
                    <div class="col-10">
                    <vs-input
                        type="text"
                        size="default"
                        :placeholder="'Khuyến mãi ' + i"
                        class="w-100"
                        v-model="objData.preserve[i].detail"
                    />
                    <br />
                    </div>
                    <div class="col-2">
                    <a
                        href="javascript:;"
                        v-if="i != 0"
                        @click="remoteAr(i,'preserve')"
                    >
                        <img v-bind:src="'/media/' + joke.avatar" width="25" />
                    </a>
                    </div>
                </div>
                </div>

                <el-button size="small" @click="addInput('preserve')"
                >Thêm khuyến mãi</el-button
                >
            </div>

            <div class="form-group">
                <label>Đơn vị tính</label>
                <vs-input
                type="text"
                size="default"
                placeholder="Đơn vị tính"
                class="w-100"
                v-model="objData.species"
                />
            </div>

            <div class="form-group">
                <label>Thời gian bảo hành</label>
                <vs-input
                type="text"
                size="default"
                placeholder="Thời gian bảo hành"
                class="w-100"
                v-model="objData.thickness"
                />
            </div>

            <div class="form-group">
                <label>Thêm phân loại</label>
                <div v-for="(item, i) in objData.origin" :key="i">
                <div class="row">
                    <div class="col-10">
                    <vs-input
                        type="text"
                        size="default"
                        :placeholder="'Phân loại ' + i"
                        class="w-100"
                        v-model="objData.origin[i].title"
                    />
                    <image-upload
                        v-model="objData.origin[i].image"
                        type="avatar"
                        :title="'phan-loai'"
                    ></image-upload>
                    <br />
                    </div>
                    <div class="col-2">
                    <a
                        href="javascript:;"
                        v-if="i != 0"
                        @click="remoteAr(i,'origin')"
                    >
                        <img v-bind:src="'/media/' + joke.avatar" width="25" />
                    </a>
                    </div>
                </div>
                </div>
                <el-button size="small" @click="addInput('origin')"
                >Thêm phân loại</el-button>
            </div>

            <div class="form-group">
                <label>Tag sale</label>
                <image-upload
                v-model="objData.hang_muc"
                type="avatar"
                :title="'tag-sale'">
                </image-upload>
            </div>
            
            <div class="form-group">
                <label>Sản phẩm nổi bật</label>
                <vs-select v-model="objData.discountStatus">
                <vs-select-item value="1" text="Có" />
                <vs-select-item value="0" text="Không" />
                </vs-select>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row fixxed">
        <div class="col-12">
        <div class="saveButton">
            <vs-button color="primary" @click="saveProducts"
            >Thêm mới</vs-button
            >
        </div>
        </div>
    </div>
    </div>
</template>


<script>
import { mapActions } from "vuex";
import TinyMce from "../_common/tinymce";
import ImageMulti from "../_common/upload_image_multi";
import "tinymce/icons/default/icons.min.js";
import InputTag from "vue-input-tag";
export default {
name: "product",
data() {
    return {
    cate: [],
    joke: {
        avatar: "delete-sign--v2.png",
    },
    type_cate: [],
    type_two:[],
    showLang: {
        title: false,
        content: false,
        description: false,
    },
    lang: [],
    promotion: [],
    brands: [],
    combo : [],
    errors: [],
    objData: {
        lang: "",
        name: [
        {
            lang_code: "vi",
            content: "",
        },
        ],
        size: [
        {
            title: "",
            detail: ""
        },
        ],
        price: 0,
        discount: 0,
        preserve:[
        {
            detail: ""
        }
        ],
        ingredient:'',
        images: [],
        qty: "",
        description: [
        {
            lang_code: "vi",
            content: "",
        },
        ],
        content: [
        {
            lang_code: "vi",
            content: "",
        },
        ],
        category: 0,
        status: 1,
        brand_id: '',
        combo_id: '',
        promotion_id: '',
        discountStatus:0,
        type_cate: 0,
        type_two:0,
        species: "",
        origin: [
        {
            title: '',
            image: ''
        },
        ],
        thickness: "",
        hang_muc: "",
        sku: ""
    },
    };
},
components: {
    TinyMce,
    ImageMulti,
    InputTag,
},
computed: {},
watch: {
},
methods: {
    ...mapActions([
    "editId",
    "saveProduct",
    "listCate",
    "loadings",
    "listLanguage",
    "findTypeCate",
    "findTypeCateTwo",
    "listProductBrand",
    "listProductCombo",
    "listPromotion"
    ]),
    saveProducts() {
    this.errors = [];
    if(this.objData.name[0].content == '') this.errors.push('Tên không được để trống');
    if(this.objData.content[0].content == '') this.errors.push('Nội dung không được để trống');
    if(this.objData.description[0].content == '') this.errors.push('Mô tả không được để trống');
    // if(this.objData.images.length < 2) this.errors.push('Vui lòng chọn thêm ảnh. Cần ít nhất 2 ảnh');
    if(this.objData.category == 0) this.errors.push('Chọn danh mục sản phẩm');
    if(this.objData.brand_id == '') this.errors.push('Chọn thương hiệu sản phẩm');

    if (this.errors.length > 0) {
        this.errors.forEach((value, key) => {
        this.$error(value);
        });
        return;
    } else {
        this.loadings(true);

        this.saveProduct(this.objData)
        .then((response) => {
            this.loadings(false);
            this.$router.push({ name: "listProduct" });
            this.$success("Thêm sản phẩm thành công");
            this.$route.push({ name: "listProduct" });
        })
        .catch((error) => {
            this.loadings(false);
            // this.$vs.notify({
            //   title: "Thất bại",
            //   text: "Thất bại",
            //   color: "danger",
            //   position: "top-right"
            // });
        });
    }
    },
    findCategoryType() {
    this.findTypeCate(this.objData.category).then((response) => {
        this.type_cate = response.data;
    });
    },
    findCategoryTypeTwo() {
    this.findTypeCateTwo(this.objData.type_cate).then((response) => {
        this.type_two = response.data;
    });
    },
    remoteAr(index,key) {
    if(key == 'size'){
        this.objData.size.splice(index, 1);
    }
    if(key == 'preserve'){
        this.objData.preserve.splice(index, 1);
    }
    if(key == 'origin'){
        this.objData.origin.splice(index, 1);
    }

    },
    addInput(key) {
        var oj = {};
        if(key =='size'){
        oj.title = "";
        oj.detail = "";
        this.objData.size.push(oj);
        }
        if(key =='preserve'){
        oj.detail = "";
        this.objData.preserve.push(oj);
        }
        if(key =='origin'){
        oj.title = "";
        oj.image = "";
        this.objData.origin.push(oj);
        }

    },
    showSettingLangExist(value, name = "content") {
    if (value == "content") {
        this.showLang.content = !this.showLang.content;
        this.lang.forEach((value, index) => {
        if (
            !this.objData.content[index] &&
            value.code != this.objData.content[0].lang_code
        ) {
            var oj = {};
            oj.lang_code = value.code;
            oj.content = "";
            this.objData.content.push(oj);
        }
        });
    }
    if (value == "description") {
        this.showLang.description = !this.showLang.description;
        this.lang.forEach((value, index) => {
        if (
            !this.objData.description[index] &&
            value.code != this.objData.description[0].lang_code
        ) {
            var oj = {};
            oj.lang_code = value.code;
            oj.content = "";
            this.objData.description.push(oj);
        }
        });
    }
    if (value == "name") {
        this.showLang.title = !this.showLang.title;
        this.lang.forEach((value, index) => {
        if (
            !this.objData.name[index] &&
            value.code != this.objData.name[0].lang_code
        ) {
            var oj = {};
            oj.lang_code = value.code;
            oj.content = "";
            this.objData.name.push(oj);
        }
        });
    }
    },
    listLang() {
    this.listLanguage()
        .then((response) => {
        this.loadings(false);
        this.lang = response.data;
        })
        .catch((error) => {});
    },
},
mounted() {
    this.loadings(true);
    this.listCate().then((response) => {
    this.loadings(false);
    this.cate = response.data;
    });
    this.listProductBrand().then((response) => {
    this.loadings(false);
    this.brands = response.data;
    });
    this.listProductCombo().then((response) => {
    this.loadings(false);
    this.combo = response.data;
    });
    this.listPromotion().then((response) => {
    this.loadings(false);
    this.promotion = response.data;
    });
    this.listLang();
},
};
</script>
