Fractal Symfony Bundle
==================================

This package provides subset of fractal features to your symfony application + adds few symfony-specific features, like 
sub-requests via Httpkernel and batch resource fetching.

**Please note** that current version of this library should not be considered as stable. API could be changed.

## Roadmap

 - [x] Basic API
 - [ ] Bundle and Configuration
 - [ ] ResponseFilter listeners
 - [ ] Integrate optional Symfony Normalizer post-processing
 - [ ] Batch Load of related resources (one-to-one, many-to-one) via includes
 - [ ] Batch Load of related resources (one-to-many, many-to-many) via includes
 - [ ] Batch Load Cache
 - [ ] Documentation and Examples

## Usage

First of all, we need to install bundle.

TBD

```php
class UserController extends Controller
{
    use FractalTrait;
    
    public function productDetailsAction(Product $product)
    {
        return $this
            ->item($product)
            ->usingTransformer(new ProductTransformer())
            ->includeMatcing([
                'comments' => $this->isGranted('SEE_COMMENTS')
            ])
            ->asJsonResponse();
    }
}

```

TBD
