<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;



class AuthController extends Controller
{

     /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Authentication"},
     *     summary="Register a new user",
     *     description="Register a new user with the provided credentials",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="secret"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User successfully registered",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User registered successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid"),
     *             @OA\Property(property="errors", type="object", example={"email": {"The email field is required."}})
     *         )
     *     )
     * )
     */
   
    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {

         /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Authentication"},
     *     summary="Log in a user",
     *     description="Log in a user with the provided credentials",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="secret"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User logged in successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."),
     *             @OA\Property(property="token_type", type="string", example="Bearer"),
     *             @OA\Property(property="expires_in", type="integer", example=3600)
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Invalid credentials")
     *         )
     *     )
     * )
     */


        // Validation des données
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // En cas d'erreur de validation, renvoyer les erreurs
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Création d'un token pour l'utilisateur nouvellement enregistré
        $token = $this->createToken($user, 'app_token');

        // Réponse JSON avec l'utilisateur et le token
        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"Authentication"},
     *     summary="Log out the authenticated user",
     *     description="Log out the currently authenticated user",
     *     @OA\Response(
     *         response=200,
     *         description="User logged out successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User logged out successfully")
     *         )
     *     )
     * )
     */

        // Vérifier les informations d'identification de l'utilisateur
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Supprimer les anciens jetons de l'utilisateur
            $this->deleteTokens($user);

            // Création d'un nouveau token pour l'utilisateur
            $token = $this->createToken($user, 'app_token');

            // Réponse JSON avec l'utilisateur et le token
            return response()->json(['user' => $user, 'token' => $token], 200);
        }

        // En cas d'échec de l'authentification
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    /**
     * Crée un nouveau token pour l'utilisateur spécifié.
     *
     * @param  \App\Models\User  $user
     * @param  string  $tokenName
     * @return string
     */
    private function createToken(User $user, $tokenName)
    {
        return $user->createToken($tokenName)->plainTextToken;
    }

    /**
     * Supprime tous les tokens de l'utilisateur spécifié.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    private function deleteTokens(User $user)
    {
        $user->tokens()->delete();
    }


    public function registerWithImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Exemple de validation pour l'image
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Traitement de l'image ici, si elle est incluse dans la requête
    
        // Enregistrement de l'utilisateur avec les autres données du formulaire
    
        return response()->json(['message' => 'User registered successfully'], 201);
    }
    
 


}


