<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHomePageSliderRequest;
use App\Http\Requests\StoreHomePageSliderRequest;
use App\Http\Requests\UpdateHomePageSliderRequest;
use App\Models\HomePageSlider;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class HomePageSliderController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('home_page_slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $homePageSliders = HomePageSlider::all();

        return view('admin.homePageSliders.index', compact('homePageSliders'));
    }

    public function create()
    {
        abort_if(Gate::denies('home_page_slider_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.homePageSliders.create');
    }

    public function store(StoreHomePageSliderRequest $request)
    {
        $homePageSlider = HomePageSlider::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $homePageSlider->id]);
        }

        return redirect()->route('admin.home-page-sliders.index');
    }

    public function edit(HomePageSlider $homePageSlider)
    {
        abort_if(Gate::denies('home_page_slider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.homePageSliders.edit', compact('homePageSlider'));
    }

    public function update(UpdateHomePageSliderRequest $request, HomePageSlider $homePageSlider)
    {
        $homePageSlider->update($request->all());

        return redirect()->route('admin.home-page-sliders.index');
    }

    public function show(HomePageSlider $homePageSlider)
    {
        abort_if(Gate::denies('home_page_slider_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.homePageSliders.show', compact('homePageSlider'));
    }

    public function destroy(HomePageSlider $homePageSlider)
    {
        abort_if(Gate::denies('home_page_slider_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $homePageSlider->delete();

        return back();
    }

    public function massDestroy(MassDestroyHomePageSliderRequest $request)
    {
        HomePageSlider::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('home_page_slider_create') && Gate::denies('home_page_slider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new HomePageSlider();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
