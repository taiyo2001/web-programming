<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Money_management;
use Illuminate\Support\Facades\Auth;
use App\Services\ManagementService;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;


class ManagementController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $managements = Money_management::orderBy('created_at', 'DESC')->get();

        $total = 0;
        foreach($managements as $management) {
            $total += $management->amount_money;
        }

        return view('management.index')->with('managements', $managements)->with('total', $total);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'purchase'      => 'required',
            'date'          => 'required',
            'amount_money'  => 'required',
            'memo'          => 'required|max:140',
        ]);

        $managements = new Money_management();
        $managements->user_id       = Auth::id();
        $managements->purchase      = $validatedData['purchase'];
        $managements->date          = $validatedData['date'];
        $managements->amount_money  = $validatedData['amount_money'];
        $managements->memo          = $validatedData['memo'];
        $managements->save();
        return redirect()->route('management.show');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateIndex(Request $request, ManagementService $managementService)
    {
        $managementId = (int) $request->route('managementId');

        if(!$managementService->checkOwnManagement(Auth::id(), $managementId)) {
            throw new AccessDeniedHttpException;
        }

        $management = Money_management::where('id', $managementId)->firstOrFail();
        return view('management.update')->with('management', $management);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePut(Request $request, ManagementService $managementService)
    {

        if(!$managementService->checkOwnManagement(Auth::id(), $request->managementId)) {
            throw new AccessDeniedHttpException;
        }

        $validatedData = $request->validate([
            'purchase'      => 'required',
            'date'          => 'required',
            'amount_money'  => 'required',
            'memo'          => 'required|max:140',
        ]);

        $management = Money_management::where('id', $request->managementId)->firstOrFail();
        $management->purchase      = $validatedData['purchase'];
        $management->date          = $validatedData['date'];
        $management->amount_money  = $validatedData['amount_money'];
        $management->memo          = $validatedData['memo'];
        $management->save();
        return redirect()->route('management.update.index', ['managementId' => $management->id])->with('feedback.success', "家計簿を編集しました");
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, ManagementService $managementService)
    {
        $managementId = (int) $request->route('managementId');

        if(!$managementService->checkOwnManagement(Auth::id(), $request->managementId)) {
            throw new AccessDeniedHttpException;
        }

        $management = Money_management::where('id', $managementId)->firstOrFail();
        $management->delete();
        return redirect()->route('management.show')->with('feedback.success', "家計簿を削除しました");
    }
}
