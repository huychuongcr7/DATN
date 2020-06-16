<template>
    <div style="padding-bottom:20px">
        <div>
            <star-rating read-only v-model="rateAvg" :increment="0.1" :starSize="30" :show-rating="false"></star-rating>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            "avg",
        ],
        created() {
            this.rateAvg = JSON.parse(this.avg) || null;
        },
        data() {
            return {
                rateAvg: 0,
            }
        }
    }
</script>
