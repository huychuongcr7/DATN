<template>
    <div>
        <div class="form-group form-show-validation row">
            <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Sản phẩm
                <span class="required-label">*</span>
            </label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <button data-toggle="modal" data-target="#productModal" type="button" :class="`btn btn-success`">Lựa chọn</button>
                <div v-if="errors.import_order_products">
                    <div class="text-danger">{{ errors.import_order_products[0] }}</div>
                </div>
                <table class="display table table-striped table-hover" v-if="productsData.length > 0">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã SP</th>
                        <th>Tên SP</th>
                        <th width="20%">Số lượng</th>
                        <th width="20%">Đơn giá</th>
                        <th>Thành tiền</th>
                        <th v-if="productsData.length > 1">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(product, index) in productsData" :key="index">
                        <input type="hidden" :name="`import_order_products[${index}][product_id]`" v-model="product.id">
                        <input type="hidden" :name="`import_order_products[${index}][id]`" v-model="product.import_order_product_id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ product.product_code}}</td>
                        <td>{{ product.name}}</td>
                        <td>
                            <input type="number" class="form-control" :name="`import_order_products[${index}][quantity]`" v-model="product.quantity">
                            <div v-if="errors[`import_order_products.${index}.quantity`]" class="text-danger">{{ errors[`import_order_products.${index}.quantity`][0] }}</div>
                        </td>
                        <td>
                            <input type="number" class="form-control" :name="`import_order_products[${index}][unit_price]`" v-model="product.unit_price">
                            <div v-if="errors[`import_order_products.${index}.unit_price`]" class="text-danger">{{ errors[`import_order_products.${index}.unit_price`][0] }}</div>
                        </td>
                        <td v-if="product.unit_price">{{ formatMoney(product.quantity * product.unit_price) }} VNĐ</td>
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
        <div class="form-group form-show-validation row" v-if="totalMoney">
            <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Tổng tiền</label>
            <div class="col-lg-6 col-md-9 col-sm-6">
                <input name="total_money" class="form-control" type="text" :value="totalMoney" readonly>
            </div>
        </div>
        <div id="productModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
            <div class="modal-dialog modal-success" style="max-width: 60%;">
                <!-- Modal product-->
                <div class="modal-content text-center">
                    <div class="modal-header py-2">
                        <h3 class="modal-title title-lv3 w-100">Lựa chọn sản phẩm</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">Mã sản phẩm</label>
                                <input type="text" class="form-control" v-model="product_code_search" name="product_code_search">
                            <label class="form-check-label ml-3">Tên sản phẩm</label>
                                <input type="text" class="form-control" v-model="name_search" name="name_search">
                            <label class="form-check-label ml-5">Tồn kho</label>
                                <input type="text" class="form-control" v-model="inventory_search" name="inventory_search">
                        </div>
                        <table id="bannerModalTable" class="display table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Tồn kho</th>
                                <th>Ngày tạo</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(product, index) in filteredProduct" :key="index" >
                                <td>{{ product.id }}</td>
                                <td>{{ product.product_code}}</td>
                                <td>{{ product.name}}</td>
                                <td v-if="product.image_url"><img :src="`${product.image_url}`" class="img-upload-preview" width="100" height="100" alt="preview"></td>
                                <td v-else></td>
                                <td>{{ product.inventory}}</td>
                                <td>{{ product.created_at }}</td>
                                <td>
                                    <input type="checkbox" :id="product.id" :value="product" v-model="selectedProduct">
                                </td>
                            </tr>
                            </tbody>
                        </table>
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
            "importOrderDetail",
            "svErrors"
        ],
        created() {
            this.products = JSON.parse(this.allProducts) || [];
            this.rowDataProduct = JSON.parse(this.importOrderDetail) ? JSON.parse(this.importOrderDetail) : [];
            const productIds = this.rowDataProduct.map(r => parseInt(r.product_id));
            const currentProducts = this.products.filter(product => productIds.includes(product.id));
            this.selectedProduct = currentProducts.map(r => {
                const currentProduct = this.rowDataProduct.find(b => b.product_id == r.id);
                return {
                    ...r,
                    quantity: currentProduct.quantity,
                    unit_price: currentProduct.unit_price,
                    import_order_product_id: currentProduct.id
                }
            });
            this.errors = JSON.parse(this.svErrors) || [];
            this.productsData = this.selectedProduct ? this.selectedProduct : null;
        },
        data() {
            return {
                products: [],
                productsData: null,
                selectedProduct: [],
                rowDataProduct: [],
                product_code_search: '',
                name_search: '',
                inventory_search: '',
                import_order_products: [],
                errors: [],
            }
        },
        computed: {
            filteredProduct() {
                let {product_code_search, name_search, inventory_search, products} = this;
                let searchProducts = products;
                if (product_code_search) {
                    searchProducts = searchProducts.filter(product => (product.product_code.includes(product_code_search)));
                }
                if (name_search) {
                    searchProducts = searchProducts.filter(product => (product.name.includes(name_search)));
                }
                if (inventory_search) {
                    searchProducts = searchProducts.filter(product => (product.inventory == inventory_search));
                }
                return searchProducts
            },
            totalMoney: function(){
                let sum = 0;
                this.productsData.forEach(function(product) {
                    sum += (parseFloat(product.unit_price) * parseFloat(product.quantity));
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
            }
        }
    }
</script>
