<?php
namespace App\Services;
use App\Traits\ApiResponseTrait;
use App\Models\GymSession;
use Illuminate\Http\Request;
class GymSessionService
{
    use ApiResponseTrait;
    /**
         * show session by using session_id
         *
         * @param [type] $id
         * @return \Illuminate\Http\JsonResponse

         */
    public function showgymsession($id)
    {
        try {
            $session = GymSession::with([
                'course',
                'trainer',
                'category',
            ])->findOrFail($id);

            return $this->successResponse($session, "تم جلب الجلسة بنجاح", 200);

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 404);
        }
    }
    /**
* show the session to the user with json response 
* he can filter it by course_id cateroy_id profile_trainer_id
*
* @param Request $request
  * @return \Illuminate\Http\JsonResponse

*/
    public function indexgymsession(Request $request)
    {
        try {
            $query = GymSession::with([
                'course',
                'trainer',
                'category',
            ]);

            foreach (['category_id', 'course_id', 'trainer_profile_id'] as $field) {
                $query->when($request->has($field), function ($q) use ($request, $field) {
                    $q->where($field, $request->$field);
                });
            }
            // $query = GymSession::with(['course','trainer','category'])
            //     ->when($request->has('category_id'), fn($q) => $q->where('category_id', $request->category_id))
            //   ->when($request->has('course_id'), fn($q) => $q->where('course_id', $request->course_id))
        //     //   ->when($request->has('trainer_profile_id'), fn($q) => $q->where('trainer_profile_id', $request->trainer_profile_id));



            $sessions = $query->get();

            if ($sessions->isEmpty()) {

                return $this->errorResponse('لا توجد جلسات مطابقة لخيارات الفلترة', 404);
            }

            return $this->successResponse($sessions, "تم جلب الجلسات بالنجاح ", 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);


        }
   }
}
