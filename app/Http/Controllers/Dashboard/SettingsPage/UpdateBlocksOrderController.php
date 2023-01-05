<?php

namespace App\Http\Controllers\Dashboard\SettingsPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SettingsPage\UpdateBlocksOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UpdateBlocksOrderController extends Controller
{
    public function __invoke(UpdateBlocksOrderRequest $request)
    {
        try {
            $data = $request->validated();
            foreach ($data['blocks'] as $block) {
                auth()->user()->page->blocks()->find($block['id'])->update(['order' => $block['order']]);
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }

        return redirect()->back()->with('success', 'Blocks order updated successfully.');
    }
}
