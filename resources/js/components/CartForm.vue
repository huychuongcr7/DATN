<template>
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col"><label class="text-black">STT</label></th>
                <th scope="col"><label class="text-black">Tên sản phẩm</label></th>
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
                <td>{{ formatMoney(product.sale_price) }} VNĐ</td>
                <td>
                    <input type="number" class="form-control" :name="`carts[${index}][quantity]`" v-model="product.quantity">
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
    </div>
</template>

<script>
    export default {
        props: [
            "allProducts",
            "indexUrl",
            "deleteUrl",
            "href"
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
                axios.delete(this.deleteUrl.replace('%productId', product.id))
                    .then((response) => {
                        window.location.href = this.indexUrl;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            formatMoney(value) {
                let val = (value / 1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            }
        }
    }
</script>
