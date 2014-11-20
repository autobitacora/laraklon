<?php

use Zizaco\Confide\ConfideUserInterface;

class ConfideValidatorFix extends Zizaco\Confide\UserValidator {

    public $rules = [
        'create' => [
            'legajo' => 'required|integer',
            'password' => 'required|min:5',
        ],
        'update' => [
            'legajo' => 'required|integer',
            'password' => 'required|min:5',
        ]
    ];

    /**
     * Validates if the given user is unique. If there is another
     * user with the same credentials but a different id, this
     * method will return false.
     *
     * @param ConfideUserInterface $user
     *
     * @return boolean True if user is unique.
     */
    public function validateIsUnique(ConfideUserInterface $user)
    {
        $identity = [
            'legajo'    => $user->legajo,
        ];

        foreach ($identity as $attribute => $value) {

            $similar = $this->repo->getUserByIdentity([$attribute => $value]);

            if (!$similar || $similar->getKey() == $user->getKey()) {
                unset($identity[$attribute]);
            } else {
                $this->attachErrorMsg(
                    $user,
                    'confide::confide.alerts.duplicated_credentials',
                    $attribute
                );
            }

        }

        if (!$identity) {
            return true;
        }

        return false;
    }

}

class ConfideUserFix extends Zizaco\Confide\EloquentRepository {

    public function getUserByEmailOrUsername($emailOrUsername) {
        $identity = [
            'legajo' => $emailOrUsername
        ];
        return $this->getUserByIdentity($identity);
    }

}

class ConfideUsernameFix extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /confideusernamefix
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /confideusernamefix/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /confideusernamefix
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /confideusernamefix/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /confideusernamefix/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /confideusernamefix/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /confideusernamefix/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}