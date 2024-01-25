<script setup>
import Pagination from '../Components/Pagination.vue';
const props = defineProps({
    explainers: Object,
    locale: String,
});
</script>

<template>
    <Head :title="__('Explainers')" />
    <div class="sjupage allnews">
        <div class="section page-header">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link :href="route('home')">{{ __('Home') }}</Link>
                        </li>
                    </ul>
                </nav>

                <h3>{{ __('Candidates heading') }}</h3>
            </div>
        </div>

        <div class="page-content">
            <div class="container">
                <template v-if="explainers.data.length">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="col-sm-6 col-md-4 mb-4" v-for="explainer in explainers.data" :key="explainer.id">

                                    <div class="card text-center h-100">
                                        <div class="card-body">
                                            <Link :href="explainer.path" as="h5" style="height: 50px" class="card-title">{{
                                                explainer.name }}</Link>
                                            <a :href="explainer.path" class="btn btn-success btn-sm mt-2 ripple-surface" target="_blank">
                                                {{ __('CV') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

            </div>
        </div>
    </div>
</template>

<script defer>
import App from '../../Layouts/App.vue';
export default {
    layout: App,
    mounted() { },
};
</script>
