<?php

namespace App\Repositories;

use App\Models\Admin;

class FramesReportRepository
{
    public function getAllHqFrames(Admin $admin)
    {
        $organization = $admin->organization;
        return $organization->hq_frame_stock()->with([
            'frame', 'frame_color', 'frame_shape'
        ])->latest()->get();
    }

    public function getAllFrames($request, $admin_id)
    {
        $admin = Admin::findOrFail($admin_id);

        if ($admin) {
            $organization = $admin->organization;
            $data = $organization->frame()->latest()->get();
            return $data;
        }
    }
}
