<template>
    <div>
        <h5 class="text-black">Đánh giá sản phẩm</h5>
        <div v-if="isBuyed">
            <input type="hidden" name="product_id" v-model="product_id">
            <star-rating v-model="rating" text-class="custom-text"></star-rating>
            <div class="col-md-9 form-group" style="padding-left: 0; padding-top: 20px">
                <label class="text-black">Bình luận:</label>
                <textarea class="form-control" name="comment" v-model="comment"></textarea>
            </div>
            <button class="btn btn-primary" @click="rate">Gửi đánh giá</button>
        </div>
        <div v-else><p>Vui lòng mua hàng để được đánh giá sản phẩm của chúng tôi 😀</p></div>
        <div v-for="rateProduct in rateProducts" style="padding-top: 100px">
            <ul class="comment-list">
                <li class="comment">
                    <div class="vcard bio">
                        <img :src="rateProduct.avatar ? `/storage${rateProduct.avatar}` : 'http://placehold.it/100x100'" alt="Image placeholder">
                    </div>
                    <div class="comment-body">
                        <h3>{{ rateProduct.name }}</h3>
                        <div class="meta">{{ rateProduct.created_at }}</div>
                        <star-rating v-model="rateProduct.rating" read-only :starSize="20"></star-rating>
                        <p>{{ rateProduct.comment }}</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            "productId",
            "createRate",
            "rates",
            "isBuyed"
        ],
        created() {
            this.product_id = JSON.parse(this.productId) || null;
            this.rateProducts = JSON.parse(this.rates) || [];
        },
        data() {
            return {
                rating: 0,
                product_id: 0,
                comment: null,
                rateProducts: [],
            }
        },
        methods: {
            rate() {
                axios.post(this.createRate, {product_id: this.product_id, rating: this.rating, comment: this.comment})
                    .then((response) => {
                        this.$swal({
                            title: 'Thành công',
                            text: 'Bạn đã đánh giá sản phẩm thành công!',
                            icon: 'success',
                            timer: 5000
                        });
                        location.reload();
                    })
                    .catch((err) => {
                        this.$swal({
                            title: 'Thất bại',
                            text: 'Bạn phải nhập đủ các trường chỉ định!',
                            icon: 'error',
                            timer: 5000
                        });
                    });
            },
        }
    }
</script>
