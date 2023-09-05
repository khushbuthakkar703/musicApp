<?php

namespace App\Http\Controllers;

use App\CampaignPrices;
use Illuminate\Http\Request;

class CampaignPricesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $price=$request->price;
        $campaignPrice=new CampaignPricesController();
        $campaignPrice->price=$price;
        $campaignPrice->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CampaignPrices  $campaignPrices
     * @return \Illuminate\Http\Response
     */
    public function show(CampaignPrices $campaignPrices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CampaignPrices  $campaignPrices
     * @return \Illuminate\Http\Response
     */
    public function edit(CampaignPrices $campaignPrices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CampaignPrices  $campaignPrices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CampaignPrices $campaignPrices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CampaignPrices  $campaignPrices
     * @return \Illuminate\Http\Response
     */
    public function destroy(CampaignPrices $campaignPrices)
    {
        //
        $price=CampaignPrices::find($campaignPrices)->first();
        if($price)
        {
            $price->delete();
        }
    }
}
