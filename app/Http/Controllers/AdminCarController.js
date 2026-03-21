// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// class AdminCarController extends Controller
// {
//     public function create()
//     {
//         return view('admin.add_car');
//     }

//     public function store(Request $request)
//     {
//         $data = $request->validate([
//             'name' => 'required',
//             'brand' => 'required',
//             'price' => 'required',
//             'image' => 'required|image'
//         ]);

//         // Upload image
//         if ($request->hasFile('image')) {
//             $image = $request->file('image')->store('car', 'public');
//             $data['image'] = $image;
//         }

//         DB::table('car')->insert($data);

//         return back()->with('success', 'Car Added Successfully');
//     }
// }