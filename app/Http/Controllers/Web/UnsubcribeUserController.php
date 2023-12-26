<?php

namespace AMGPortal\Http\Controllers\Web;

use Illuminate\Http\Request;
use AMGPortal\UnsubcribeUser;
use AMGPortal\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class UnsubcribeUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {
            $result = UnsubcribeUser::where('email', $search)->get();
        } else {
            $result = UnsubcribeUser::take(5000)->get();
        }

        return view('unsubcribeusers.index', ['result' => $result]);
    }

    public function create()
    {
        return view('unsubcribeusers.add');
    }

    public function store(Request $request)
    {
        if (!empty($request->input('email'))) {

            $email = $request->input('email');

            $lines = explode("\n", $email);

            $data = array_map('trim', $lines);

            $storeData = [];

            foreach ($data as $key => $row) {
                
                $record = UnsubcribeUser::on('other_database')->where('email', $row)->first();
                
                if ($record) {
                    $associatedEmail = $record ? $record->email : '';

                    return redirect()->back()->withErrors('Sorry, this email "'.$associatedEmail.'" has already been taken!')->withInput();
                }
                
                $domain = explode('@', $row);

                $storeData[] = [
                    'email' => $row,
                    'domain' => $domain[1],
                    'osrc' => 'MANUAL-IMPORT',
                    'timestamp' => Carbon::now()
                ];
            }
        } else {

            $request->validate([
                'file' => 'required|mimes:csv,txt',
            ]);

            $file = $request->file('file');
            $filePath = $file->getRealPath();
            $extension = $file->getClientOriginalExtension();

            $data = [];

            if ($extension === 'csv') {
                $data = array_map('str_getcsv', file($filePath));
            } elseif ($extension === 'txt') {
                $data = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $data = array_map(function ($line) {
                    return explode(',', $line);
                }, $data);
            }

            if (empty($data)) {
                return redirect()->back()->withErrors('Invalid file format. Only CSV and TXT files are allowed.');
            }

            $headers = array_shift($data);

            foreach ($data as $row) {

                $record = UnsubcribeUser::on('other_database')->where('email', $row[0])->first();

                if ($record) {
                    $associatedEmail = $record ? $record->email : '';

                    return redirect()->back()->withErrors('Sorry, this email "'.$associatedEmail.'" has already been taken!')->withInput();
                }

                $domain = explode('@', $row[0]);

                $storeData[] = [
                    'email' => $row[0],
                    'domain' => $domain[1],
                    'osrc' => 'MANUAL-IMPORT',
                    'timestamp' => Carbon::now()
                ];
            }
        }

        UnsubcribeUser::on('other_database')->insert($storeData);

        return redirect()->route('unsubscribe.create')
            ->with('success', 'Unsubscribe users created successfully.');
    }

    public function delete($email, $osrc)
    {
        try {
            $record = UnsubcribeUser::on('other_database')->where('email', $email)->where('osrc', $osrc);
            if (!$record) {
                return response()->json(['error' => 'Record not found'], 404);
            }

            $record->delete();

            return response()->json(['success' => 'Unsubscribe user deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
}
