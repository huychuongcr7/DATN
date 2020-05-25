<template>
    <div>
        <div v-if="products.length > 0">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col"><label class="text-black">STT</label></th>
                <th scope="col"><label class="text-black">Tên sản phẩm</label></th>
                <th scope="col"><label class="text-black">Hình ảnh</label></th>
                <th scope="col"><label class="text-black">Đơn giá</label></th>
                <th scope="col" width="20%"><label class="text-black">Số lượng</label></th>
                <th scope="col"><label class="text-black">Số tiền</label></th>
                <th scope="col"><a><label class="text-black">Thao tác</label></a></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(product, index) in products" :key="index">
                <input type="hidden" :name="`carts[${index}][product_id]`" v-model="product.id">
                <input type="hidden" name="total_money" :value="totalMoney">
                <td>{{ index + 1 }}</td>
                <td>
                    <a :href="href.replace('%id%', product.id)" class="text-center my-3">{{ product.name }}</a>
                </td>
                <td v-if="product.image_url"><img :src="`/storage${product.image_url}`" class="img-upload-preview" width="100" height="100" alt="preview"></td>
                <td>{{ formatMoney(product.sale_price) }} VNĐ</td>
                <td>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-outline-dark" @click="minusProduct(product)" style="padding-left: 20px; padding-right: 20px; padding-bottom:8px">
                                <i class="icon-minus"></i>
                            </button>
                        </span>
                        <input type="number" class="form-control" :name="`carts[${index}][quantity]`" v-model="product.quantity">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-outline-dark" @click="plusProduct(product)" style="padding-left: 20px; padding-right: 20px; padding-bottom:8px">
                                <i class="icon-plus"></i>
                            </button>
                        </span>
                    </div>
                </td>
                <td>{{ formatMoney(product.sale_price*product.quantity) }} VNĐ</td>
                <td>
                    <button type="button" class="btn btn-danger" @click="deleteProduct(product, index)">
                        <i class="icon-trash"></i>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
        <h3 class="text-black">Tổng tiền: <span class="text-danger">{{ formatMoney(totalMoney) }} VNĐ</span></h3>
            <a class="btn btn-primary" :href="createBill">Thanh toán</a>
        </div>
        <div v-else class="text-center">
            <h3 class="text-black">Không có sản phẩm nào trong giỏ hàng</h3>
            <a class="btn btn-primary" :href ="welcome"> Mua ngay</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            "allProducts",
            "deleteUrl",
            "href",
            "updateUrl",
            "createBill",
            "welcome"
        ],
        created() {
            this.products = JSON.parse(this.allProducts) || [];
        },
        data() {
            return {
                products: [],
            }
        },
        computed: {
            totalMoney: function () {
                let sum = 0;
                this.products.forEach(function (product) {
                    sum += (parseFloat(product.sale_price) * parseFloat(product.quantity));
                });
                return sum;
            }
        },
        methods: {
            deleteProduct(product, index) {
                this.products.splice(index, 1);
                axios.delete(this.deleteUrl.replace('%productId', product.id))
                    .then((response) => {
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            formatMoney(value) {
                let val = (value / 1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            minusProduct(product) {
                product.quantity--;
                axios.put(this.updateUrl.replace('%productId', product.id), {quantity: product.quantity})
                    .then((response) => {
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            plusProduct(product) {
                product.quantity++
                axios.put(this.updateUrl.replace('%productId', product.id), {quantity: product.quantity})
                    .then((response) => {
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        }
    }
</script>
