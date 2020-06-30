<template>
    <div>
        <div class="form-group form-show-validation row">
            <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Sản phẩm
                <span class="required-label">*</span>
            </label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <button data-toggle="modal" data-target="#productModal" type="button" :class="`btn btn-success`">Lựa chọn</button>
                <div v-if="errors.check_inventory_products">
                    <div class="text-danger">{{ errors.check_inventory_products[0] }}</div>
                </div>
                <table class="display table table-striped table-hover" v-if="productsData.length > 0">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã SP</th>
                        <th>Tên SP</th>
                        <th>Tồn kho</th>
                        <th>Thực tế</th>
                        <th>Số lượng lệch</th>
                        <th>Giá trị lệch</th>
                        <th v-if="productsData.length > 1">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(product, index) in productsData" :key="index">
                        <input type="hidden" :name="`check_inventory_products[${index}][product_id]`" v-model="product.id">
                        <input type="hidden" :name="`check_inventory_products[${index}][id]`" v-model="product.check_inventory_product_id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ product.product_code}}</td>
                        <td>{{ product.name}}</td>
                        <td>{{ product.inventory}}</td>
                        <td>
                            <input type="number" class="form-control" :name="`check_inventory_products[${index}][inventory_reality]`" v-model="product.inventory_reality">
                            <div v-if="errors[`check_inventory_products.${index}.inventory_reality`]" class="text-danger">{{ errors[`check_inventory_products.${index}.inventory_reality`][0] }}</div>
                        </td>
                        <td v-if="product.inventory_reality">
                            <input type="hidden" :name="`check_inventory_products[${index}][difference]`" v-model="product.inventory_reality - product.inventory">
                            {{ product.inventory_reality - product.inventory }}
                        </td>
                        <td v-else></td>
                        <td v-if="product.inventory_reality">{{ formatMoney((product.inventory_reality - product.inventory) * product.entry_price) }} VNĐ</td>
                        <td v-else></td>
                        <td>
                            <button type="button" class="btn btn-danger" v-if="productsData.length > 1" @click="delRowProduct(index)">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-group form-show-validation row" v-if="totalDifference >= 0">
            <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Tổng chênh lệch</label>
            <div class="col-lg-6 col-md-9 col-sm-6">
                <input name="total_difference" class="form-control" type="text" :value="totalDifference" readonly>
            </div>
        </div>
        <div class="modal fade" id="productModal" tabindex="-1" role="diaglog" aria-labelledby="myModalLacel" aria-hidden="true">
            <div class="modal-dialog modal-success" style="max-width: 50%;">
                <!-- Modal product-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Lựa chọn sản phẩm</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hiden="true">x</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="app">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">Mã sản phẩm</label>
                                <input type="text" class="form-control" v-model="product_code_search" name="product_code_search">
                                <label class="form-check-label ml-3">Tên sản phẩm</label>
                                <input type="text" class="form-control" v-model="name_search" name="name_search">
                            </div>
                            <div class="d-flex flex-wrap overflow-auto">
                                <div v-for="product in filteredProduct" :key="product.data.id" class="col-3 p-2 position-relative">
                                    <div class="img-thumbnail" :class="`img-thumbnail ${product.selected ? 'border-success bg-success' : ''}`" @click="select(product.data)">
                                        <div  class="photo-box w-100 position-relative">
                                            <img :src="product.data.image_url ? `${product.data.image_url}` : 'http://placehold.it/100x100'" class="img-upload-preview" width="100" height="100" alt="preview"/>
                                        </div>
                                        <div class="col text-left">
                                            <a :class="`${product.selected ? 'text-white' : ''}`" target="_blank" rel="noopener noreferrer" :href="href.replace('%id%', product.data.id)" class="text-center my-3">{{ product.data.name }}</a>
                                            <p :class="`${product.selected ? 'text-white' : ''}`">Tồn kho: {{ formatMoney(product.data.inventory) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" @click="addProduct()" data-dismiss="modal">Chấp nhận</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            "allProducts",
            "checkInventoryDetail",
            "svErrors",
            "href"
        ],
        created() {
            this.products = JSON.parse(this.allProducts) || [];
            this.rowDataProduct = JSON.parse(this.checkInventoryDetail) ? JSON.parse(this.checkInventoryDetail) : [];
            const productIds = this.rowDataProduct.map(r => parseInt(r.product_id));
            const currentProducts = this.products.filter(product => productIds.includes(product.id));
            this.selectedProduct = currentProducts.map(r => {
                const currentProduct = this.rowDataProduct.find(b => b.product_id == r.id);
                return {
                    ...r,
                    inventory_reality: currentProduct.inventory_reality,
                    check_inventory_product_id: currentProduct.id
                }
            });
            this.errors = JSON.parse(this.svErrors) || [];
            this.productsData = this.selectedProduct ? this.selectedProduct : [];
        },
        data() {
            return {
                products: [],
                productsData: null,
                selectedProduct: [],
                rowDataProduct: [],
                product_code_search: '',
                name_search: '',
                check_inventory_products: [],
                errors: [],
            }
        },
        computed: {
            filteredProduct() {
                let {product_code_search, name_search, products} = this;
                let searchProducts = products;
                if (product_code_search) {
                    searchProducts = searchProducts.filter(product => (product.product_code.includes(product_code_search)));
                }
                if (name_search) {
                    searchProducts = searchProducts.filter(product => (product.name.includes(name_search)));
                }
                return searchProducts.map(r => {
                    return {
                        selected: this.selectedProduct.includes(r),
                        data: r
                    }
                })
            },
            totalDifference: function(){
                let sum = 0;
                this.productsData.forEach(function(product) {
                    sum += (parseFloat(product.inventory_reality) - parseFloat(product.inventory));
                });
                return sum;
            }
        },
        methods: {
            addProduct() {
                return this.productsData = this.selectedProduct;
            },
            delRowProduct(index) {
                this.productsData.splice(index, 1);
            },
            formatMoney(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            select(product) {
                if(this.selectedProduct.includes(product)) {
                    this.selectedProduct = this.selectedProduct.filter(r => r !== product)
                } else {
                    this.selectedProduct.push(product)
                }
            }
        }
    }
</script>
