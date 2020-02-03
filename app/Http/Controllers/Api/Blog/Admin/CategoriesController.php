<?php

namespace App\Http\Controllers\Api\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BlogCategoryRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
  @OA\Info(
      description="",
      version="1.0.0",
      title="App API",
 )
 */

/**
  @OA\SecurityScheme(
      securityScheme="bearerAuth",
          type="http",
          scheme="bearer",
          bearerFormat="JWT"
      ),
 */
/**
 * Class CategoriesController
 * @package App\Http\Controllers\Api\Blog\Admin
 */
class CategoriesController extends Controller
{
    /**
     * @var BlogCategoryRepositoryInterface
     */
    private $blogCategoryRepository;

    /**
     * CategoriesController constructor.
     * @param BlogCategoryRepositoryInterface $blogCategoryRepository
     */
    public function __construct(BlogCategoryRepositoryInterface $blogCategoryRepository)
    {
        $this->blogCategoryRepository = $blogCategoryRepository;
    }

    /**
        @OA\Get(
            path="/api/categories/",
            tags={"Categories"},
            summary="Categories get",
            operationId="category-all",

            @OA\Response(
                response=200,
                description="Success",
                @OA\MediaType(
                mediaType="application/json",
                )
            ),
        )
     */
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = $this->blogCategoryRepository->all();

        return new JsonResponse($categories, Response::HTTP_OK);
    }

    /**
        @OA\Get(
            path="/api/categories/{id}",
            tags={"Categories"},
            summary="Categories",
            operationId="category-show",

            @OA\Parameter(
                name="id",
                in="path",
                required=true,
                @OA\Schema(
                type="integer"
                )
            ),
            @OA\Response(
                response=200,
                description="Success",
                @OA\MediaType(
                  mediaType="application/json",
                )
            ),
        )
     */
    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $category = $this->blogCategoryRepository->find($id);

        return new JsonResponse($category, Response::HTTP_OK);
    }

    /**
        @OA\Post(
        path="/api/categories",
        tags={"Categories"},
        summary="Categories",
        operationId="category-create",
        @OA\RequestBody(
            description="Category to add to the store",
            required=true,
            @OA\JsonContent(ref="#/components/schemas/BlogCategory")
        ),
        @OA\Response(
          response=200,
          description="Success",
          @OA\MediaType(
              mediaType="application/json",
          )
        ),
        @OA\Response(
          response=400,
          description="Invalid request"
        ),
        @OA\Response(
          response=404,
          description="not found"
        ),
      )
     */
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $category = $this->blogCategoryRepository->create($request->request->all());

        return new JsonResponse($category, Response::HTTP_CREATED);
    }

    /**
        @OA\Put(
            path="/api/categories/{id}",
            tags={"Categories"},
            summary="Categories",
            operationId="category-update",
      @OA\Parameter(
    name="id",
    in="path",
    required=true,
    @OA\Schema(
    type="integer"
    )
    ),
            @OA\RequestBody(
                description="Category to update in the store",
                required=true,
                @OA\JsonContent(ref="#/components/schemas/BlogCategory")
            ),
            @OA\Response(
                response=200,
                description="Success",
                @OA\MediaType(
                mediaType="application/json",
                )
            ),
            @OA\Response(
                response=400,
                description="Invalid request"
            ),
        )
     */
    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $category = $this->blogCategoryRepository->find($id);

        if ($category === null) {
            throw new NotFoundHttpException();
        }

        $category = $this->blogCategoryRepository->update($category, $request->request->all());

        return new JsonResponse($category, Response::HTTP_OK);
    }

    /**
    @OA\Delete(
        path="/api/categories/{id}",
        tags={"Categories"},
        summary="Categories",
        operationId="category-delete",

        @OA\Parameter(
            name="id",
            in="path",
            required=true,
            @OA\Schema(
            type="integer"
            )
        ),
        @OA\Response(
            response=200,
            description="Success",
            @OA\MediaType(
            mediaType="application/json",
            )
        ),
        @OA\Response(
            response=204,
            description="no content"
        ),
    )
     */
    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $this->blogCategoryRepository->delete($id);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
